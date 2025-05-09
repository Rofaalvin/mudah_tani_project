<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Anda bisa mengambil data produk dari database atau langsung menambahkannya ke view
        return view('beranda.index');
    }
}
