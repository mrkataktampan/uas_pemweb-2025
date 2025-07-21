<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Mass assignable attributes.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar_url',
        'name',
        'email',
        'password',
    ];

    /**
     * Hidden attributes.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator: Hash password automatically (if not already hashed).
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            // Jangan hash ulang kalau sudah hashed
            $this->attributes['password'] = 
                \Illuminate\Support\Str::startsWith($value, '$2y$')
                    ? $value
                    : bcrypt($value);
        }
    }

    /**
     * Avatar for Filament.
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->avatar_url) {
            return asset('storage/' . $this->avatar_url);
        }

        $hash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?d=mp&r=g&s=250";
    }

    /**
     * Who can access Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Atur sesuai dengan role atau akses yang diizinkan
    }
}