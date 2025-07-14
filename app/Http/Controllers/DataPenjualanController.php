<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanItem;
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
        // Ambil parameter filter
    $filterUser = $request->get('filter_user');
    $filterBulan = $request->get('filter_bulan');

    // Query menggunakan Eloquent dengan eager loading
    $query = PenjualanItem::with(['penjualan.user', 'produk'])
        ->whereHas('penjualan')
        ->orderBy('created_at', 'desc');

    // Filter berdasarkan user/pembeli
    if ($filterUser) {
        $query->whereHas('penjualan', function ($q) use ($filterUser) {
            $q->where('id_pembeli', $filterUser);
        });
    }

    // Filter berdasarkan bulan
    if ($filterBulan) {
        $query->whereHas('penjualan', function ($q) use ($filterBulan) {
            $q->whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$filterBulan]);
        });
    }

    // Paginasi
    $dataPenjualans = $query->paginate(15)->appends($request->query());

    // Transform data untuk view
    $dataPenjualans->getCollection()->transform(function ($item) {
        return (object) [
            'id' => $item->id,
            'kode_trx_jual' => $item->penjualan->kode_trx_jual,
            'nama_pembeli' => $item->penjualan->user->name ?? 'Tidak diketahui',
            'nama_barang' => $item->nama_produk,
            'quantity' => $item->quantity,
            'harga' => $item->harga,
            'total' => $item->subtotal,
            'tanggal' => $item->penjualan->tanggal,
        ];
    });

    // Ambil data users untuk dropdown filter
    $users = User::where('role', 'pembeli')->get();

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
