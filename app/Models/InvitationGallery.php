<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationGallery extends Model
{
    protected $fillable = ['invitation_id','path','caption','sort_order'];

    public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }
    public function getUrl(): string { return asset('storage/'.$this->path); }
}
