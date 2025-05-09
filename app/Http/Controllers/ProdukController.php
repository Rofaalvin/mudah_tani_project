<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('penjual.produk.index', compact('produks'));
    }

    public function create()
    {
        return view('penjual.produk.create');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('penjual.produk.edit', compact('produk'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate ID Produk baru dengan format B0001, B0002, ...
        $lastProduk = Produk::latest('id_produk')->first();
        $lastId = $lastProduk ? (int) substr($lastProduk->id_produk, 1) : 0;
        $newId = 'B' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        // Menambahkan ID Produk ke dalam data yang disimpan
        $validated['id_produk'] = $newId;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/produk'), $namaFile);
            $validated['gambar'] = 'images/produk/' . $namaFile;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/produk'), $namaFile);
            $validated['gambar'] = 'images/produk/' . $namaFile;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Optional: hapus file gambar juga
        // if ($produk->gambar && file_exists(public_path($produk->gambar))) {
        //     unlink(public_path($produk->gambar));
        // }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }

    public function addItem(Request $request)
{
    $validated = $request->validate([
        'id_produk' => 'required|string',
        'nama_barang' => 'required|string',
        'harga_satuan' => 'required|numeric',
        'jumlah' => 'required|integer|min:1',
    ]);

    $items = session()->get('pembelian_items', []);

    $id = Str::uuid()->toString();

    $items[] = [
        'id' => $id,
        'id_produk' => $validated['id_produk'],
        'nama_barang' => $validated['nama_barang'],
        'harga_satuan' => $validated['harga_satuan'],
        'jumlah' => $validated['jumlah'],
        'harga_akhir' => $validated['harga_satuan'] * $validated['jumlah'],
    ];

    session()->put('pembelian_items', $items);

    return redirect()->back()->with('success', 'Item berhasil ditambahkan.');
}

}
