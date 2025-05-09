<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenjualan extends Model
{
    use HasFactory;

    protected $table = 'data_penjualan'; // atau sesuain nama tabel kamu

    protected $primaryKey = 'id_data_jual';

    public $timestamps = false; // Kalau tidak ada created_at / updated_at

    protected $fillable = [
        'kode_trx_jual',
        'id_barang',
        'harga',
    ];
}
