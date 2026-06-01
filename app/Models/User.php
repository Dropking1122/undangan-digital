<?php
namespace App\Models;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','is_admin'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at'=>'datetime','password'=>'hashed','is_admin'=>'boolean'];

    public function canAccessPanel(Panel $panel): bool { return $this->is_admin === true; }
    public function invitations(): HasMany { return $this->hasMany(Invitation::class); }
    public function subscriptions(): HasMany { return $this->hasMany(Subscription::class); }
    public function activeSubscription(): HasOne { return $this->hasOne(Subscription::class)->where('status','active')->latest(); }
    public function isAdmin(): bool { return (bool)$this->is_admin; }
    public function getActivePlan(): ?Plan { return $this->activeSubscription?->plan; }
}
