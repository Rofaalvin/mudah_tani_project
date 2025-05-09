<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';

    protected $primaryKey = 'id_barang';

    public $incrementing = false; // karena id_barang bukan auto increment
    protected $keyType = 'string'; // karena id_barang mungkin berupa kode seperti BRG001

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'total',
    ];

    public $timestamps = false;
}
