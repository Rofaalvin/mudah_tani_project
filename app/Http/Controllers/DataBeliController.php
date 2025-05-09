<?php

namespace App\Http\Controllers;

use App\Models\DataBeli;
use Illuminate\Http\Request;

class DataBeliController extends Controller
{
    public function index()
    {
        $cartItems = session('cart_pembelian', []); // jika tidak ada data, return array kosong
        $pembelianInfo = session('pembelianInfo', [
            'kode_trx_beli' => '-',
            'nama_supplyer' => '-',
            'tanggal' => '-',
        ]);

        if (!is_array($cartItems)) {
            $cartItems = [];
        }

        return view('penjual.data_beli.index', compact('cartItems', 'pembelianInfo'));
    }

    public function store(Request $request)
{
    $cartItems = session('cart_pembelian', []);
    $pembelianInfo = session('pembelianInfo', []);

    foreach ($cartItems as $item) {
        DataBeli::create([
            'kode_trx_beli' => $pembelianInfo['kode_trx_beli'],
            'id_supplyer' => $pembelianInfo['id_supplyer'] ?? null, // sesuaikan dengan strukturmu
            'nama_barang' => $item['nama_barang'],
            'quantity' => $item['quantity'],
            'harga' => $item['harga'],
            'total' => $item['total'],
            'tanggal' => $pembelianInfo['tanggal'],
        ]);
    }

    // Kosongkan session setelah simpan
    session()->forget(['cart_pembelian', 'pembelianInfo']);

    return redirect()->route('data_beli.index')->with('success', 'Data pembelian berhasil disimpan.');
}


}
