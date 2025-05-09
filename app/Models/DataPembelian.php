<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPembelian extends Model
{
    use HasFactory;

    protected $table = 'data_pembelian';
    protected $primaryKey = 'id_data_pembelian';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_trx_beli',
        'id_supplyer',
        'nama_barang',
        'quantity',
        'harga',
        'total',
        'tanggal',
    ];

    public $timestamps = false;

    public function supplyer()
    {
        return $this->belongsTo(Supplyer::class, 'id_supplyer', 'id_supplyer');
    }
}
