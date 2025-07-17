<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'kode_trx_jual',
        'id_pembeli',
        'id_barang',
        'nama_barang',
        'quantity',
        'harga',
        'total',
        'diskon',
        'total_final',
        'tanggal',
        'status',
        'delivery_method',
        'shipping_cost',
        'shipping_address',
        'shipping_status',
        'from_cashier', // Menandakan apakah transaksi berasal dari kasir
    ];

    // Relasi dengan Pembeli
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli', 'id_pembeli');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pembeli', 'id');
    }

    public function items()
    {
        return $this->hasMany(PenjualanItem::class, 'penjualan_id');
    }
}
