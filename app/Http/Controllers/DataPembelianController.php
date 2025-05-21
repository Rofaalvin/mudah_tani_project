<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;

class DataPembelianController extends Controller
{
    public function index()
    {
        // Ambil data dengan relasi supplyer dan paginasi 10 data per halaman
        $data_pembelian = Pembelian::with('supplyer')->paginate(10);
        return view('admin.data_pembelian.index', compact('data_pembelian'));
    }
}
