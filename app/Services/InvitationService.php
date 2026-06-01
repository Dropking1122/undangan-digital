<?php
namespace App\Services;
use App\Models\Invitation;
use App\Models\Template;
use App\Models\User;
use Illuminate\Support\Str;

class InvitationService
{
    public function create(User $user, Template $template, array $data): Invitation
    {
        $slug = $this->generateUniqueSlug($data['slug'] ?? $data['title']);
        return Invitation::create([
            'user_id' => $user->id,
            'template_id' => $template->id,
            'title' => $data['title'],
            'slug' => $slug,
            'status' => 'draft',
            'invitation_data' => $data['invitation_data'] ?? [],
            'theme_settings' => $template->getDefaultThemeSettings(),
            'sections' => $template->getDefaultSections(),
        ]);
    }

    public function update(Invitation $invitation, array $data): Invitation
    {
        $invitation->update($data);
        return $invitation->fresh();
    }

    public function updateInvitationData(Invitation $invitation, array $invitationData): void
    {
        $invitation->update(['invitation_data' => array_merge($invitation->getInvitationData(), $invitationData)]);
    }

    public function updateThemeSettings(Invitation $invitation, array $themeSettings): void
    {
        $invitation->update(['theme_settings' => array_merge($invitation->getThemeSettings(), $themeSettings)]);
    }

    public function updateSections(Invitation $invitation, array $sections): void
    {
        $invitation->update(['sections' => array_merge($invitation->getSections(), $sections)]);
    }

    public function publish(Invitation $invitation): Invitation
    {
        $invitation->update(['status' => 'published', 'published_at' => now()]);
        return $invitation->fresh();
    }

    public function unpublish(Invitation $invitation): Invitation
    {
        $invitation->update(['status' => 'draft', 'published_at' => null]);
        return $invitation->fresh();
    }

    public function delete(Invitation $invitation): void
    {
        $invitation->delete();
    }

    private function generateUniqueSlug(string $base): string
    {
        $slug = Str::slug($base);
        $original = $slug;
        $count = 1;
        while (Invitation::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}
