<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvitationMusic extends Model
{
    protected $table = 'invitation_musics';
    protected $fillable = ['invitation_id','path','title','auto_play','loop','is_active'];
    protected $casts = ['auto_play'=>'boolean','loop'=>'boolean','is_active'=>'boolean'];

    public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }
    public function getUrl(): string { return asset('storage/'.$this->path); }
}
