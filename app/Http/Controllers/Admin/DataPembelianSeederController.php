<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DataPembelianSeederController extends Controller
{
    public function runSeeder()
    {
        // Truncate data lama
        DB::table('data_pembelian')->truncate();

        // Ambil data dari pembelian
        $pembelian = DB::table('pembelian')->get();

        foreach ($pembelian as $item) {
            DB::table('data_pembelian')->insert([
                'kode_trx_beli'     => $item->kode_trx_beli,
                'id_supplyer'       => $item->id_supplyer,
                'nama_barang'       => $item->nama_barang,
                'quantity'          => $item->quantity,
                'harga'             => $item->harga,
                'total'             => $item->total,
                'tanggal'           => $item->tanggal,
            ]);
        }

        return redirect()->back()->with('success', 'Seeder berhasil dijalankan.');
    }
}
