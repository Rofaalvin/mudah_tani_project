<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Pembeli extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';
    protected $keyType = 'string';

    protected $fillable = [
        'id_penjual',
        'nama_pembeli',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
