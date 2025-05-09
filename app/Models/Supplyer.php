<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplyer extends Model
{
    use HasFactory;

    protected $table = 'supplyer';
    protected $primaryKey = 'id_supplyer';

    // Jika tidak ada kolom created_at dan updated_at
    public $timestamps = false;

    // Karena kamu pakai ID manual, bukan auto-increment
    public $incrementing = false;

    // Karena ID menggunakan string (misalnya 'SPL001')
    protected $keyType = 'string';

    // Kolom yang bisa diisi
    protected $fillable = ['id_supplyer', 'alamat', 'nama_supplyer'];

    // Relasi ke Pembelian (1 Supplyer dapat memiliki banyak Pembelian)
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'id_supplyer', 'id_supplyer');
    }
}

