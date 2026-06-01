<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Invitation extends Model
{
    use SoftDeletes;
    protected $fillable = ['uuid','user_id','template_id','title','slug','status','invitation_data','theme_settings','sections','custom_domain','published_at'];
    protected $casts = ['invitation_data'=>'array','theme_settings'=>'array','sections'=>'array','published_at'=>'datetime'];

    protected static function booted(): void {
        static::creating(fn($m) => $m->uuid ??= Str::uuid());
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function template(): BelongsTo { return $this->belongsTo(Template::class); }
    public function galleries(): HasMany { return $this->hasMany(InvitationGallery::class)->orderBy('sort_order'); }
    public function music(): HasOne { return $this->hasOne(InvitationMusic::class); }
    public function rsvps(): HasMany { return $this->hasMany(Rsvp::class)->latest(); }
    public function guestbookEntries(): HasMany { return $this->hasMany(GuestbookEntry::class)->latest(); }
    public function digitalGifts(): HasMany { return $this->hasMany(DigitalGift::class)->orderBy('sort_order'); }

    public function isPublished(): bool { return $this->status === 'published'; }
    public function isDraft(): bool { return $this->status === 'draft'; }

    public function getInvitationData(): array { return $this->invitation_data ?? []; }
    public function getThemeSettings(): array {
        return $this->theme_settings ?? $this->template?->getDefaultThemeSettings() ?? [];
    }
    public function getSections(): array {
        return $this->sections ?? $this->template?->getDefaultSections() ?? [];
    }
    public function isSectionEnabled(string $section): bool {
        return (bool)($this->getSections()[$section] ?? false);
    }
}
