<?php

namespace App\Http\Controllers;

use App\Models\Supplyer;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    /**
     * Menampilkan daftar supplier dengan fungsionalitas pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Mulai query, jangan langsung ambil semua data
        $query = Supplyer::query();

        // Jika ada kata kunci pencarian, tambahkan kondisi where
        if ($search) {
            // Cari berdasarkan nama, alamat, atau bahkan ID supplier
            $query->where('nama_supplyer', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('id_supplyer', 'like', "%{$search}%");
        }

        // Ambil data dengan paginasi (misal: 10 per halaman) dan urutkan
        // dari yang terbaru. Sertakan juga query string pada link paginasi.
        $suppliers = $query->latest()->paginate(10)->appends($request->query());

        // Kirim data yang sudah difilter dan dipaginasi ke view
        return view('admin.supplyer.index', compact('suppliers', 'search'));
    }

    public function create()
    {
        return view('admin.supplyer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplyer' => 'required|unique:supplyer,id_supplyer',
            'nama_supplyer' => 'required|string|max:255',
            'alamat' => 'required',
        ]);

        Supplyer::create($request->only(['id_supplyer', 'nama_supplyer', 'alamat']));

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplyer::findOrFail($id);
        return view('admin.supplyer.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplyer' => 'required|string|max:255',
            'alamat' => 'required',
        ]);

        $supplier = Supplyer::findOrFail($id);
        $supplier->update($request->only(['nama_supplyer', 'alamat']));

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = Supplyer::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil dihapus.');
    }
}
