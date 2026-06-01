<?php
namespace App\Services;
use App\Models\Invitation;
use App\Models\InvitationGallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function upload(Invitation $invitation, UploadedFile $file): InvitationGallery
    {
        $path = $file->store('gallery/' . $invitation->uuid, 'public');
        $maxOrder = $invitation->galleries()->max('sort_order') ?? 0;
        return InvitationGallery::create([
            'invitation_id' => $invitation->id,
            'path' => $path,
            'sort_order' => $maxOrder + 1,
        ]);
    }

    public function delete(InvitationGallery $gallery): void
    {
        Storage::disk('public')->delete($gallery->path);
        $gallery->delete();
    }

    public function reorder(Invitation $invitation, array $orderedIds): void
    {
        foreach ($orderedIds as $order => $id) {
            InvitationGallery::where('id', $id)
                ->where('invitation_id', $invitation->id)
                ->update(['sort_order' => $order + 1]);
        }
    }
}
