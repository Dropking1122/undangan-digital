<?php
namespace App\Services;
use App\Models\Invitation;
use App\Models\InvitationMusic;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MusicService
{
    public function upload(Invitation $invitation, UploadedFile $file, array $options = []): InvitationMusic
    {
        $existing = $invitation->music;
        if ($existing && $existing->path) {
            Storage::disk('public')->delete($existing->path);
        }
        $path = $file->store('music/' . $invitation->uuid, 'public');
        return InvitationMusic::updateOrCreate(
            ['invitation_id' => $invitation->id],
            array_merge([
                'path' => $path,
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'auto_play' => true,
                'loop' => true,
                'is_active' => true,
            ], $options)
        );
    }

    public function update(InvitationMusic $music, array $data): void
    {
        $music->update($data);
    }

    public function delete(InvitationMusic $music): void
    {
        if ($music->path) {
            Storage::disk('public')->delete($music->path);
        }
        $music->delete();
    }
}
