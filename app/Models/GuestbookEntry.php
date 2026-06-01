<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestbookEntry extends Model
{
    protected $fillable = ['invitation_id','name','message','is_visible'];
    protected $casts = ['is_visible'=>'boolean'];

    public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }
}
