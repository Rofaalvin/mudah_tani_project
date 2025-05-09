<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBeli extends Model
{
    protected $table = 'data_beli';
    protected $primaryKey = 'id_data_pembelian';
    public $timestamps = false;

    protected $fillable = [
        'kode_trx_beli',
        'id_supplyer',
        'nama_barang',
        'quantity',
        'harga',
        'total',
        'tanggal',
    ];
}
