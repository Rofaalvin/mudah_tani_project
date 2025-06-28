<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Menampilkan daftar stok produk dengan fungsionalitas pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Mulai query ke model Produk
        $query = Produk::query();

        // Jika ada input pencarian, tambahkan kondisi filter
        if ($search) {
            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('id_produk', 'like', "%{$search}%");
        }

        // Ambil data dengan paginasi (misal: 15 per halaman) dan urutkan berdasarkan nama.
        // Jangan lupa sertakan query string pada link paginasi agar filter tetap aktif.
        $produks = $query->orderBy('nama_produk', 'asc')->paginate(15)->appends($request->query());

        // Kirim data yang sudah siap ke view
        return view('admin.stok.index', compact('produks', 'search'));
    }
}
