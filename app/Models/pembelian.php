<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'kode_trx_beli';

    public $incrementing = false; // karena bukan auto increment
    protected $keyType = 'string'; // karena kode_trx_beli berupa string

    protected $fillable = [
        'kode_trx_beli',
        'id_supplyer',
        'id_barang',
        'nama_barang',
        'quantity',
        'harga',
        'total',
        'tanggal',
    ];

    public $timestamps = false;

    // Relasi ke Supplyer
    public function supplyer()
    {
        return $this->belongsTo(Supplyer::class, 'id_supplyer', 'id_supplyer');
    }
}
