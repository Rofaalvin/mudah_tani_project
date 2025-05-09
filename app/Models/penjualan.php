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
        'tanggal',
    ];

    // Relasi dengan Pembeli
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli' , 'id_pembeli');
    }
}
