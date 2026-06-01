<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rsvp extends Model
{
    protected $fillable = ['invitation_id','name','attendance','guest_count','message','phone'];
    protected $casts = ['guest_count'=>'integer'];

    public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }

    public function isAttending(): bool { return $this->attendance === 'attending'; }
    public function isNotAttending(): bool { return $this->attendance === 'not_attending'; }
}
