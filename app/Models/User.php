<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_wa',       
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Helper role ──

    public function isPemilik(): bool
    {
        return $this->role === 'pemilik';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPencari(): bool
    {
        return $this->role === 'pencari';
    }

    // ── Relasi ──

    public function kos()
    {
        return $this->hasMany(Kos::class);
    }
}
