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
    public string $eventDate          = '';
    public string $location           = '';

    protected $rules = [
        'selectedTemplateId' => 'required|exists:templates,id',
        'groomName'          => 'required|string|max:100',
        'brideName'          => 'required|string|max:100',
        'eventDate'          => 'nullable|date',
        'location'           => 'nullable|string|max:200',
    ];

    public function updatedGroomName(): void
    {
        $this->autoFillTitle();
    }

    public function updatedBrideName(): void
    {
        $this->autoFillTitle();
    }

    private function autoFillTitle(): void
    {
        if ($this->groomName && $this->brideName) {
            $this->invitationTitle = 'Pernikahan ' . $this->groomName . ' & ' . $this->brideName;
        }
    }

    public function createInvitation(): void
    {
        $this->validate();

        if (empty($this->invitationTitle)) {
            $this->invitationTitle = 'Pernikahan ' . $this->groomName . ' & ' . $this->brideName;
        }

        $template   = Template::findOrFail($this->selectedTemplateId);
        $invitation = app(InvitationService::class)->create(auth()->user(), $template, [
            'title'           => $this->invitationTitle,
            'invitation_data' => [
                'groom_name' => $this->groomName,
                'bride_name' => $this->brideName,
                'event_date' => $this->eventDate ?: null,
                'location'   => $this->location ?: null,
            ],
        ]);

        $this->reset(['showCreateModal', 'selectedTemplateId', 'invitationTitle', 'groomName', 'brideName', 'eventDate', 'location']);
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
