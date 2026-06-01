<?php
namespace App\Http\Controllers;
use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(string $slug)
    {
        $invitation = Invitation::where('slug', $slug)->with('template')->firstOrFail();
        if (!$invitation->isPublished()) {
            abort(404, 'Undangan belum dipublikasikan.');
        }
        return view('invitation.show', compact('invitation'));
    }
}
