<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        // Ambil semua data stok
        $stok = Stok::all();
        return view('admin.stok.index', compact('stok'));
    }

}
