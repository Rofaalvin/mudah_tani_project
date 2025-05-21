<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('beranda.index', compact('produks'));
    }

    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }
}
