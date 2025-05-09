<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukJualController extends Controller
{
    /**
     * Tampilkan semua produk.
     */
    public function index()
{
    // Ambil data dari database atau sumber lainnya
    $produk = [
        (object)['nama'=>'Barang A', 'harga_jual'=>11111],
        (object)['nama'=>'Barang B', 'harga_jual'=>11111]
    ];

    // Kirim data ke view dengan compact()
    return view('beranda.index', compact('produk'));

    // Atau bisa juga dengan array
    // return view('beranda', ['produk' => $produk]);
}

    /**
     * Tampilkan form tambah produk.
     */
    public function create()
    {
        return view('beranda.create');
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_produk' => 'required|string|unique:produk,id_produk',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create($validated);

        return redirect()->route('beranda.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('beranda.edit', compact('produk'));
    }

    /**
     * Update data produk.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $produk->update($validated);

        return redirect()->route('beranda.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('beranda.index')->with('success', 'Produk berhasil dihapus.');
    }
}
