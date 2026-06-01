<?php
namespace App\Livewire\Dashboard;

use App\Models\Invitation;
use App\Models\Template;
use App\Services\InvitationService;
use Livewire\Component;

class InvitationList extends Component
{
    public bool   $showCreateModal    = false;
    public int    $selectedTemplateId = 0;
    public string $invitationTitle    = '';
    public string $groomName          = '';
    public string $brideName          = '';

    protected $rules = [
        'selectedTemplateId' => 'required|exists:templates,id',
        'invitationTitle'    => 'required|string|max:255',
    ];

    public function createInvitation(): void
    {
        $this->validate();

        $template   = Template::findOrFail($this->selectedTemplateId);
        $invitation = app(InvitationService::class)->create(auth()->user(), $template, [
            'title'           => $this->invitationTitle,
            'invitation_data' => [
                'groom_name' => $this->groomName,
                'bride_name' => $this->brideName,
            ],
        ]);

        $this->reset(['showCreateModal', 'selectedTemplateId', 'invitationTitle', 'groomName', 'brideName']);
        $this->redirect(route('builder', $invitation->uuid), navigate: true);
    }

    public function deleteInvitation(int $id): void
    {
        $invitation = Invitation::findOrFail($id);
        abort_if($invitation->user_id !== auth()->id(), 403);
        app(InvitationService::class)->delete($invitation);
        $this->dispatch('invitation-deleted');
    }

    public function render()
    {
        $invitations = auth()->user()
            ->invitations()
            ->with(['template', 'rsvps', 'galleries'])
            ->latest()
            ->get();

        $templates = Template::where('status', 'active')
            ->with('category')
            ->get();

        return view('livewire.dashboard.invitation-list', compact('invitations', 'templates'))
            ->layout('layouts.app');
    }
}
