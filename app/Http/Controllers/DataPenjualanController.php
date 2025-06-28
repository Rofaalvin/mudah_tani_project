<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataPenjualanController extends Controller
{
    /**
     * Menampilkan data penjualan dengan filter user dan bulan.
     */
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $filterUser = $request->input('filter_user');
        $filterBulan = $request->input('filter_bulan');

        // Mulai query untuk data penjualan dengan relasi 'user'
        $query = Penjualan::with('user')->latest('tanggal');

        // Terapkan filter jika ada input 'filter_user'
        if ($filterUser) {
            $query->where('id_pembeli', $filterUser);
        }

        // Terapkan filter jika ada input 'filter_bulan'
        if ($filterBulan) {
            try {
                // Ubah format YYYY-MM menjadi objek tanggal
                $date = Carbon::createFromFormat('Y-m', $filterBulan);
                // Filter berdasarkan tahun dan bulan
                $query->whereYear('tanggal', $date->year)
                    ->whereMonth('tanggal', $date->month);
            } catch (\Exception $e) {
                // Abaikan filter jika formatnya tidak valid
            }
        }

        // Ambil semua data pengguna dengan role 'pembeli' untuk dropdown filter
        $users = User::where('role', 'pembeli')->orderBy('name')->get();

        // Lakukan paginasi dan sertakan parameter filter pada link halaman
        $dataPenjualans = $query->paginate(15)->appends($request->query());

        // Kirim semua data yang diperlukan ke view
        return view('admin.data_penjualan.index', compact('dataPenjualans', 'users', 'filterUser', 'filterBulan'));
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
