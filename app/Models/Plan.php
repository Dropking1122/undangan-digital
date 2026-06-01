<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Plan extends Model
{
    protected $fillable = ['uuid','name','slug','description','price','max_invitations','can_use_premium_templates','can_upload_music','can_use_gallery','can_use_custom_domain','max_gallery_images','is_active','sort_order'];
    protected $casts = ['can_use_premium_templates'=>'boolean','can_upload_music'=>'boolean','can_use_gallery'=>'boolean','can_use_custom_domain'=>'boolean','is_active'=>'boolean'];

    protected static function booted(): void {
        static::creating(fn($m) => $m->uuid ??= Str::uuid());
    }

    public function subscriptions(): HasMany { return $this->hasMany(Subscription::class); }

    public function isFree(): bool { return $this->price === 0; }
}
