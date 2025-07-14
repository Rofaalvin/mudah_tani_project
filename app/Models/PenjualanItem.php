<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanItem extends Model
{
    use HasFactory;

    protected $table = 'penjualan_items';

    protected $fillable = [
        'penjualan_id',
        'id_produk',
        'nama_produk',
        'harga',
        'quantity',
        'subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}