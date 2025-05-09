<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPenjualanController extends Controller
{
    public function index()
    {
        $dataPenjualans = DB::table('data_penjualan')->get();
        return view('admin.data_penjualan.index', compact('dataPenjualans'));
    }

    public function create()
    {
        return view('admin.data_penjualan.create');
    }

    public function store(Request $request)
    {
        DB::table('data_penjualan')->insert([
            'kode_trx_jual' => $request->kode_trx_jual,
            'id_barang' => $request->id_barang,
            'harga' => $request->harga,
        ]);

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penjualan = DB::table('data_penjualan')->where('id_data_jual', $id)->first();
        return view('admin.data_penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        DB::table('data_penjualan')->where('id_data_jual', $id)->update([
            'kode_trx_jual' => $request->kode_trx_jual,
            'id_barang' => $request->id_barang,
            'harga' => $request->harga,
        ]);

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        DB::table('data_penjualan')->where('id_data_jual', $id)->delete();

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil dihapus.');
    }
}
