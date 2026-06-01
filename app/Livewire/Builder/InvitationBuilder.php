<?php
namespace App\Livewire\Builder;

use App\Models\Invitation;
use App\Models\InvitationGallery;
use App\Models\InvitationMusic;
use App\Models\DigitalGift;
use App\Services\InvitationService;
use App\Services\GalleryService;
use App\Services\MusicService;
use App\Services\RsvpService;
use Livewire\Component;
use Livewire\WithFileUploads;

class InvitationBuilder extends Component
{
    use WithFileUploads;

    public Invitation $invitation;
    public string $activeTab = 'event';

    public string $groomName        = '';
    public string $brideName        = '';
    public string $groomFather      = '';
    public string $groomMother      = '';
    public string $brideFather      = '';
    public string $brideMother      = '';
    public string $eventDate        = '';
    public string $eventTime        = '';
    public string $akadDate         = '';
    public string $akadTime         = '';
    public string $location         = '';
    public string $locationAddress  = '';
    public string $mapsUrl          = '';
    public string $story            = '';

    public string $primaryColor     = '#D4AF37';
    public string $secondaryColor   = '#ffffff';
    public string $fontHeading      = 'Playfair Display';
    public string $fontBody         = 'Poppins';
    public string $backgroundColor  = '#ffffff';

    public array $sections = [];

    public $musicFile = null;
    public bool $autoPlay = true;
    public bool $loop     = true;

    public $galleryFiles = [];

    public array  $gifts             = [];
    public string $giftType          = 'bank';
    public string $giftAccountName   = '';
    public string $giftAccountNumber = '';
    public string $giftBankName      = '';

    public string $saveStatus = '';
    public bool $canUseGallery = true;

    public function mount(Invitation $invitation): void
    {
        abort_if(auth()->id() !== $invitation->user_id, 403);

        $plan = auth()->user()->getActivePlan();
        $this->canUseGallery = $plan ? (bool) $plan->can_use_gallery : true;

        $this->invitation = $invitation->load(['galleries', 'music', 'digitalGifts', 'rsvps']);

        $data = $invitation->getInvitationData();
        $this->groomName       = $data['groom_name']       ?? '';
        $this->brideName       = $data['bride_name']       ?? '';
        $this->groomFather     = $data['groom_father']     ?? '';
        $this->groomMother     = $data['groom_mother']     ?? '';
        $this->brideFather     = $data['bride_father']     ?? '';
        $this->brideMother     = $data['bride_mother']     ?? '';
        $this->eventDate       = $data['event_date']       ?? '';
        $this->eventTime       = $data['event_time']       ?? '';
        $this->akadDate        = $data['akad_date']        ?? '';
        $this->akadTime        = $data['akad_time']        ?? '';
        $this->location        = $data['location']         ?? '';
        $this->locationAddress = $data['location_address'] ?? '';
        $this->mapsUrl         = $data['maps_url']         ?? '';
        $this->story           = $data['story']            ?? '';

        $theme = $invitation->getThemeSettings();
        $this->primaryColor    = $theme['primary_color']    ?? '#D4AF37';
        $this->secondaryColor  = $theme['secondary_color']  ?? '#ffffff';
        $this->fontHeading     = $theme['font_heading']     ?? 'Playfair Display';
        $this->fontBody        = $theme['font_body']        ?? 'Poppins';
        $this->backgroundColor = $theme['background_color'] ?? '#ffffff';

        $this->sections = $invitation->getSections();

        if ($invitation->music) {
            $this->autoPlay = $invitation->music->auto_play;
            $this->loop     = $invitation->music->loop;
        }

        $this->gifts = $invitation->digitalGifts->toArray();
    }

    public function save(): void
    {
        $service = app(InvitationService::class);

        $service->updateInvitationData($this->invitation, [
            'groom_name'       => $this->groomName,
            'bride_name'       => $this->brideName,
            'groom_father'     => $this->groomFather,
            'groom_mother'     => $this->groomMother,
            'bride_father'     => $this->brideFather,
            'bride_mother'     => $this->brideMother,
            'event_date'       => $this->eventDate,
            'event_time'       => $this->eventTime,
            'akad_date'        => $this->akadDate,
            'akad_time'        => $this->akadTime,
            'location'         => $this->location,
            'location_address' => $this->locationAddress,
            'maps_url'         => $this->mapsUrl,
            'story'            => $this->story,
        ]);

        $service->updateThemeSettings($this->invitation, [
            'primary_color'    => $this->primaryColor,
            'secondary_color'  => $this->secondaryColor,
            'font_heading'     => $this->fontHeading,
            'font_body'        => $this->fontBody,
            'background_color' => $this->backgroundColor,
        ]);

        $service->updateSections($this->invitation, $this->sections);

        if ($this->invitation->music) {
            app(MusicService::class)->update($this->invitation->music, [
                'auto_play' => $this->autoPlay,
                'loop'      => $this->loop,
            ]);
        }

        $this->invitation->refresh();
        $this->saveStatus = 'Tersimpan ' . now()->format('H:i');
        $this->dispatch('saved');
    }

    public function uploadMusic(): void
    {
        $this->validate(['musicFile' => 'required|file|mimes:mp3,ogg,wav|max:20480']);
        app(MusicService::class)->upload($this->invitation, $this->musicFile, [
            'auto_play' => $this->autoPlay,
            'loop'      => $this->loop,
        ]);
        $this->invitation->refresh()->load('music');
        $this->musicFile  = null;
        $this->saveStatus = 'Musik berhasil diupload!';
    }

    public function deleteMusic(): void
    {
        if ($this->invitation->music) {
            app(MusicService::class)->delete($this->invitation->music);
            $this->invitation->refresh();
        }
    }

    public function uploadGallery(): void
    {
        abort_if(!$this->canUseGallery, 403, 'Paket Basic tidak dapat menggunakan galeri foto.');
        $this->validate([
            'galleryFiles'   => 'required|array|max:10',
            'galleryFiles.*' => 'image|max:5120',
        ]);

        app(GalleryService::class)->uploadMultiple($this->invitation, $this->galleryFiles);

        $this->invitation->refresh()->load('galleries');
        $this->galleryFiles = [];
        $this->saveStatus   = 'Foto berhasil diupload!';
    }

    public function deleteGallery(int $id): void
    {
        $gallery = InvitationGallery::findOrFail($id);
        abort_if($gallery->invitation_id !== $this->invitation->id, 403);
        app(GalleryService::class)->delete($gallery);
        $this->invitation->refresh()->load('galleries');
    }

    public function addGift(): void
    {
        $this->validate([
            'giftType'          => 'required|string',
            'giftAccountName'   => 'required|string|max:100',
            'giftAccountNumber' => 'required|string|max:50',
        ]);

        DigitalGift::create([
            'invitation_id'  => $this->invitation->id,
            'type'           => $this->giftType,
            'account_name'   => $this->giftAccountName,
            'account_number' => $this->giftAccountNumber,
            'bank_name'      => $this->giftBankName,
        ]);

        $this->invitation->refresh()->load('digitalGifts');
        $this->gifts            = $this->invitation->digitalGifts->toArray();
        $this->giftAccountName  = '';
        $this->giftAccountNumber = '';
        $this->giftBankName     = '';
    }

    public function deleteGift(int $id): void
    {
        DigitalGift::where('id', $id)
            ->where('invitation_id', $this->invitation->id)
            ->delete();
        $this->invitation->refresh()->load('digitalGifts');
        $this->gifts = $this->invitation->digitalGifts->toArray();
    }

    public function publish(): void
    {
        $this->save();
        app(InvitationService::class)->publish($this->invitation);
        $this->invitation->refresh();
        $this->saveStatus = 'Undangan berhasil dipublish!';
    }

    public function unpublish(): void
    {
        app(InvitationService::class)->unpublish($this->invitation);
        $this->invitation->refresh();
        $this->saveStatus = 'Undangan dikembalikan ke draft.';
    }

    public function render()
    {
        $rsvpStats = app(RsvpService::class)->getStats($this->invitation);

        return view('livewire.builder.invitation-builder', compact('rsvpStats'))
            ->layout('layouts.builder');
    }
}
