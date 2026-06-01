<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Subscription extends Model
{
    protected $fillable = ['uuid','user_id','plan_id','status','starts_at','ends_at','payment_reference','payment_data'];
    protected $casts = ['starts_at'=>'datetime','ends_at'=>'datetime','payment_data'=>'array'];

    protected static function booted(): void {
        static::creating(fn($m) => $m->uuid ??= Str::uuid());
    }

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function plan(): BelongsTo { return $this->belongsTo(Plan::class); }

    public function isActive(): bool { return $this->status === 'active' && ($this->ends_at === null || $this->ends_at->isFuture()); }
}
