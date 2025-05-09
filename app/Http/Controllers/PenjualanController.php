<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Str;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::all();
        return view('penjual.penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        return view('penjual.penjualan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_trx_jual' => 'required|unique:penjualan',
            'tanggal_jual' => 'required|date',
            'id_pembeli' => 'required|exists:pembeli,id',
        ]);

        Penjualan::create($validated);

        return redirect()->route('penjualan.index');
    }

    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('penjual.penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $validated = $request->validate([
            'kode_trx_jual' => 'required|unique:penjualan,kode_trx_jual,' . $penjualan->id,
            'tanggal_jual' => 'required|date',
            'id_pembeli' => 'required|exists:pembeli,id',
        ]);

        $penjualan->update($validated);

        return redirect()->route('penjualan.index');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index');
    }
}
