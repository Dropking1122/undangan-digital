<?php
namespace App\Services;

use App\Models\Invitation;
use App\Models\InvitationGallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function upload(Invitation $invitation, UploadedFile $file, int $startOrder = 0): InvitationGallery
    {
        $path = $file->store('gallery/' . $invitation->uuid, 'public');
        $order = $startOrder > 0
            ? $startOrder
            : (($invitation->galleries()->max('sort_order') ?? 0) + 1);

        return InvitationGallery::create([
            'invitation_id' => $invitation->id,
            'path'          => $path,
            'sort_order'    => $order,
        ]);
    }

    public function uploadMultiple(Invitation $invitation, array $files): array
    {
        $maxOrder = $invitation->galleries()->max('sort_order') ?? 0;
        $results  = [];

        foreach ($files as $index => $file) {
            $results[] = $this->upload($invitation, $file, $maxOrder + $index + 1);
        }

        return $results;
    }

    public function delete(InvitationGallery $gallery): void
    {
        Storage::disk('public')->delete($gallery->path);
        $gallery->delete();
    }

    public function reorder(Invitation $invitation, array $orderedIds): void
    {
        DB::transaction(function () use ($invitation, $orderedIds) {
            foreach ($orderedIds as $order => $id) {
                InvitationGallery::where('id', $id)
                    ->where('invitation_id', $invitation->id)
                    ->update(['sort_order' => $order + 1]);
            }
        });
    }
}
