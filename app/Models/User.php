<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Jika kamu menggunakan Laravel Sanctum:
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang bisa diisi massal (fillable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role',
    ];

    /**
     * Atribut yang disembunyikan saat model dikonversi ke array atau JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang di-cast ke tipe data lain.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPenjual(): bool
    {
        return $this->role === 'penjual';
    }

    public function isPembeli(): bool
    {
        return $this->role === 'pembeli';
    }
}
