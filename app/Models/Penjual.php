<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Penjual extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'penjual';
    protected $primaryKey = 'id_penjual';
    protected $keyType = 'string';

    public $incrementing = false; // Hapus jika ingin auto-increment

    protected $fillable = [
        'id_penjual',
        'username',
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
