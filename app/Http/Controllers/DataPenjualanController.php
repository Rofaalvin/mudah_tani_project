<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    public function index()
    {
        $dataPenjualans = Penjualan::with('user')->get();
        return view('admin.data_penjualan.index', compact('dataPenjualans'));
    }

    public function create()
    {
        $pembelis = User::where('role', 'pembeli')->get();
        return view('admin.data_penjualan.create', compact('pembelis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_trx_jual' => 'required|string',
            'id_pembeli' => 'required|exists:users,id',
            'id_barang' => 'required|integer',
            'nama_barang' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Penjualan::create([
            'kode_trx_jual' => $request->kode_trx_jual,
            'id_pembeli' => $request->id_pembeli,
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'total' => $request->quantity * $request->harga,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pembelis = User::where('role', 'pembeli')->get();
        return view('admin.data_penjualan.edit', compact('penjualan', 'pembelis'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $validated = $request->validate([
            'kode_trx_jual' => 'required|string',
            'id_pembeli' => 'required|exists:users,id',
            'id_barang' => 'required|string',
            'nama_barang' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['harga'];

        $penjualan->update($validated);

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('data_penjualan.index')->with('success', 'Data berhasil dihapus.');
    }
}
