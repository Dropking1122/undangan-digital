<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Template extends Model
{
    use SoftDeletes;
    protected $fillable = ['uuid','category_id','name','slug','thumbnail','theme_directory','status','is_premium','default_theme_settings','default_sections','sort_order'];
    protected $casts = ['is_premium'=>'boolean','default_theme_settings'=>'array','default_sections'=>'array'];

    protected static function booted(): void {
        static::creating(fn($m) => $m->uuid ??= Str::uuid());
    }

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function invitations(): HasMany { return $this->hasMany(Invitation::class); }

    public function getDefaultThemeSettings(): array {
        return $this->default_theme_settings ?? [
            'primary_color' => '#D4AF37',
            'secondary_color' => '#ffffff',
            'font_heading' => 'Playfair Display',
            'font_body' => 'Poppins',
            'background_color' => '#ffffff',
        ];
    }

    public function getDefaultSections(): array {
        return $this->default_sections ?? [
            'cover' => true, 'couple' => true, 'countdown' => true,
            'gallery' => true, 'story' => true, 'gift' => true,
            'rsvp' => true, 'guestbook' => true, 'video' => false,
        ];
    }
}
