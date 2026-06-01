<?php
namespace App\Livewire\Public;
use App\Models\Invitation;
use App\Models\GuestbookEntry;
use App\Services\RsvpService;
use Livewire\Component;

class PublicInvitation extends Component
{
    public Invitation $invitation;
    public string $guestName = '';
    public bool $isOpened = false;

    // RSVP
    public string $rsvpName = '';
    public string $rsvpAttendance = 'attending';
    public int $rsvpGuestCount = 1;
    public string $rsvpMessage = '';
    public string $rsvpPhone = '';
    public bool $rsvpSent = false;

    // Guestbook
    public string $guestbookName = '';
    public string $guestbookMessage = '';
    public bool $guestbookSent = false;

    public function mount(Invitation $invitation): void
    {
        abort_if(!$invitation->isPublished(), 404);
        $this->invitation = $invitation->load(['template','galleries','music','digitalGifts','guestbookEntries'=>fn($q)=>$q->where('is_visible',true)->latest()->limit(20)]);
        $this->guestName = request()->query('to', '');
    }

    public function openInvitation(): void { $this->isOpened = true; }

    public function submitRsvp(): void
    {
        $this->validate([
            'rsvpName' => 'required|string|max:255',
            'rsvpAttendance' => 'required|in:attending,not_attending,maybe',
            'rsvpGuestCount' => 'integer|min:1|max:20',
            'rsvpMessage' => 'nullable|string|max:1000',
            'rsvpPhone' => 'nullable|string|max:20',
        ]);
        app(RsvpService::class)->store($this->invitation, [
            'name' => $this->rsvpName,
            'attendance' => $this->rsvpAttendance,
            'guest_count' => $this->rsvpGuestCount,
            'message' => $this->rsvpMessage,
            'phone' => $this->rsvpPhone,
        ]);
        $this->rsvpSent = true;
        $this->reset(['rsvpName','rsvpAttendance','rsvpGuestCount','rsvpMessage','rsvpPhone']);
    }

    public function submitGuestbook(): void
    {
        $this->validate([
            'guestbookName' => 'required|string|max:255',
            'guestbookMessage' => 'required|string|max:1000',
        ]);
        GuestbookEntry::create([
            'invitation_id' => $this->invitation->id,
            'name' => $this->guestbookName,
            'message' => $this->guestbookMessage,
        ]);
        $this->guestbookSent = true;
        $this->invitation->refresh()->load(['guestbookEntries'=>fn($q)=>$q->where('is_visible',true)->latest()->limit(20)]);
        $this->reset(['guestbookName','guestbookMessage']);
    }

    public function render()
    {
        $theme = $this->invitation->getThemeSettings();
        $themeDir = $this->invitation->template->theme_directory;
        return view('livewire.public.public-invitation', compact('theme','themeDir'))
            ->layout('layouts.public');
    }
}
