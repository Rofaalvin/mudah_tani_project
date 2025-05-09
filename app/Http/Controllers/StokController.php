<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        // Ambil semua data stok
        $produks = Produk::all();
        return view('admin.stok.index', compact('produks'));
    }

}
