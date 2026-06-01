<?php
namespace App\Services;
use App\Models\Invitation;
use App\Models\Rsvp;

class RsvpService
{
    public function store(Invitation $invitation, array $data): Rsvp
    {
        return Rsvp::create(array_merge($data, ['invitation_id' => $invitation->id]));
    }

    public function getStats(Invitation $invitation): array
    {
        $rsvps = $invitation->rsvps;
        return [
            'total' => $rsvps->count(),
            'attending' => $rsvps->where('attendance', 'attending')->count(),
            'not_attending' => $rsvps->where('attendance', 'not_attending')->count(),
            'maybe' => $rsvps->where('attendance', 'maybe')->count(),
            'total_guests' => $rsvps->where('attendance', 'attending')->sum('guest_count'),
        ];
    }
}
