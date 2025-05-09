<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $incrementing = false;

    protected $fillable = [
        'id_produk',
        'nama_produk',
        'harga',
        'stok',
        'gambar',
    ];
}
