<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DigitalGift extends Model
{
    protected $fillable = ['invitation_id','type','account_name','account_number','bank_name','is_visible','sort_order'];
    protected $casts = ['is_visible'=>'boolean'];

    public function invitation(): BelongsTo { return $this->belongsTo(Invitation::class); }

    public function getLabelAttribute(): string {
        return match($this->type) {
            'bank' => $this->bank_name ?? 'Bank',
            'dana' => 'DANA',
            'ovo' => 'OVO',
            'gopay' => 'GoPay',
            'shopeepay' => 'ShopeePay',
            default => $this->type,
        };
    }

    public function getIconAttribute(): string {
        return match($this->type) {
            'dana' => '💙', 'ovo' => '💜', 'gopay' => '💚',
            'shopeepay' => '🧡', default => '🏦',
        };
    }
}
