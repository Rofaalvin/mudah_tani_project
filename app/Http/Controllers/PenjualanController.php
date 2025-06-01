<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penjual;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplyer;
use App\Models\User;
use Illuminate\Support\Str;

class PenjualanController extends Controller
{
    // public function index()
    // {
    //     $penjualans = Penjualan::all();
    //     return view('penjual.penjualan.index', compact('penjualans'));
    // }

    public function index()
    {
        // Mendapatkan tanggal hari ini dalam format Y-m-d
        $today = now()->toDateString();

        // Mencari kode transaksi pembelian terakhir hari ini
        $lastKodeHariIni = Penjualan::whereDate('tanggal', $today)
            ->where('kode_trx_jual', 'like', 'PB' . now()->format('Ymd') . '%')
            ->orderBy('kode_trx_jual', 'desc')
            ->first();

        // Menentukan kode transaksi terakhir
        if ($lastKodeHariIni) {
            // Increment kode transaksi terakhir
            $lastNumber = (int) substr($lastKodeHariIni->kode_trx_jual, -3); // Ambil 3 digit terakhir sebagai angka
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi 3 digit
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . $newNumber; // Gabungkan dengan tanggal
        } else {
            // Jika tidak ada transaksi, mulai dari angka 001
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . '001';
        }

        // Mengambil data pembelian dan suppliers
        $penjualans = Penjualan::with('pembeli')->get();
        $items = session()->get('penjualan_items', []);
        $pembelis = User::where('role', 'pembeli')->get();
        $produks = Produk::all();
        // $selectedSupplyer = session('selected_supplyer');

        // Kirim data ke view
        return view('penjual.penjualan.index', compact('penjualans', 'items', 'pembelis', 'lastKodeHariIni', 'produks'));
    }

    public function create()
    {
        return view('penjual.penjualan.create');
    }

    public function setPembeli(Request $request)
    {
        $request->validate([
            'id_pembeli' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->role !== 'pembeli') {
                        $fail('Pengguna yang dipilih bukan pembeli.');
                    }
                },
            ],
        ]);

        $user = User::find($request->id_pembeli);

        session([
            'id_pembeli' => $user->id,
            'selected_pembeli' => $user->name,
        ]);

        return response()->json(['message' => 'Pembeli berhasil disimpan dalam session.']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric|min:0',
            'kode_trx_jual' => 'required|string',
        ]);

        $kodeTransaksi = $request->input('kode_trx_jual');
        $items = session()->get('cart_penjualan', []);
        $idPembeli = session('id_pembeli');

        if (!$idPembeli) {
            return redirect()->back()->with('error', 'Pembeli belum dipilih.');
        }

        if (empty($items)) {
            return redirect()->back()->with('error', 'Tidak ada item dalam transaksi.');
        }

        // Hitung total transaksi
        $totalTransaksi = 0;
        foreach ($items as $item) {
            $totalTransaksi += $item['harga_satuan'] * $item['jumlah'];
        }

        // Simpan ke tabel penjualan (hanya data transaksi)
        $penjualan = Penjualan::create([
            'kode_trx_jual' => $kodeTransaksi,
            'id_pembeli' => $idPembeli,
            'total' => $totalTransaksi,
            'tanggal' => now(),
        ]);

        // Simpan setiap item ke tabel penjualan_items
        foreach ($items as $item) {
            $penjualan->items()->create([
                'id_produk' => $item['id_produk'],
                'nama_produk' => $item['nama_produk'],
                'harga' => $item['harga_satuan'],
                'quantity' => $item['jumlah'],
                'subtotal' => $item['harga_satuan'] * $item['jumlah'],
            ]);

            // Update stok produk
            $produk = Produk::find($item['id_produk']);
            if ($produk) {
                $produk->stok -= $item['jumlah'];
                $produk->save();
            }
        }

        session()->forget(['cart_penjualan', 'id_pembeli', 'selected_pembeli']);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    public function clearAll()
    {
        session()->forget(['cart_penjualan', 'id_pembeli', 'selected_pembeli']);
        return redirect()->back()->with('success', 'Semua item berhasil dihapus.');
    }

    public function addItem(Request $request)
    {
        $item = [
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'harga_satuan' => (int) $request->harga_satuan,
            'jumlah' => (int) $request->jumlah,
        ];

        $cart = session()->get('cart_penjualan', []);
        $cart[$item['id_produk']] = $item;
        session(['cart_penjualan' => $cart]);

        return redirect()->back();
    }

    public function dataPenjualan()
    {
        $penjualans = Penjualan::with(['user', 'items'])->latest()->get();

        return view('penjual.data_jual.index', compact('penjualans'));
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
