<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penjual;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplyer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        // Validasi input, termasuk data diskon baru
        $request->validate([
            'kode_trx_jual' => 'required|string',
            'diskon' => 'required|numeric|min:0',
            'total_final' => 'required|numeric|min:0',
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

        // Hitung ulang subtotal dari session (lebih aman daripada dari client)
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['harga_satuan'] * $item['jumlah'];
        }

        // Ambil nilai diskon dan total final dari request
        $diskon = $request->input('diskon');
        $totalFinal = $request->input('total_final');

        // Simpan ke tabel penjualan (termasuk data baru)
        $penjualan = Penjualan::create([
            'kode_trx_jual' => $kodeTransaksi,
            'id_pembeli' => $idPembeli,
            'total' => $subtotal, // Menyimpan subtotal sebelum diskon
            'diskon' => $diskon, // Menyimpan persentase diskon
            'total_final' => $totalFinal, // Menyimpan total setelah diskon
            'tanggal' => now(),
            'status' => 'paid',
        ]);

        // Simpan setiap item ke tabel penjualan_items (tidak ada perubahan di sini)
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

        session()->forget(['cart_penjualan', 'id_pembeli']);

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

    public function dataPenjualan(Request $request)
    {
        // ... (Logika Grafik Penjualan Bulanan tidak berubah)
        // 1. Tentukan rentang waktu...
        $endDate = Carbon::now();
        $startDate = Carbon::now()->copy()->subMonths(5)->startOfMonth();

        // 2. Ambil data penjualan bulanan...
        $salesData = Penjualan::select(
            DB::raw('YEAR(tanggal) as year, MONTH(tanggal) as month'),
            DB::raw('SUM(total_final) as total_bulanan')
        )
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . $item->month;
            });

        // 3. Siapkan array untuk chart bulanan...
        $chartLabels = [];
        $chartData = [];

        // 4. Lakukan perulangan...
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->isoFormat('MMM YYYY');
            $key = $date->year . '-' . $date->month;
            $chartData[] = isset($salesData[$key]) ? (float) $salesData[$key]->total_bulanan : 0;
        }

        // === (BARU) LOGIKA UNTUK GRAFIK PRODUK TERLARIS BULAN INI ===
        $produkTerlarisData = PenjualanItem::select(
            'nama_produk',
            DB::raw('SUM(quantity) as total_terjual')
        )
            // Filter penjualan yang terjadi di tahun dan bulan saat ini
            ->whereHas('penjualan', function ($query) {
                $query->whereYear('tanggal', now()->year)
                    ->whereMonth('tanggal', now()->month);
            })
            ->groupBy('nama_produk')
            ->orderBy('total_terjual', 'desc')
            ->limit(5) // Ambil 5 produk teratas
            ->get();

        $produkLabels = $produkTerlarisData->pluck('nama_produk');
        $produkData = $produkTerlarisData->pluck('total_terjual');
        // === AKHIR BLOK BARU ===


        // ... (Logika untuk tabel data penjualan tidak berubah)
        $search = $request->input('search');
        $query = Penjualan::with(['user', 'items'])->latest('tanggal');
        if ($search) {
            // ... (logika search tidak berubah)
        }
        $penjualans = $query->paginate(10)->appends($request->query());

        // Kirim semua data ke view
        return view('penjual.data_jual.index', compact(
            'penjualans',
            'search',
            'chartLabels',
            'chartData',
            'produkLabels',   // Data baru untuk grafik produk
            'produkData'      // Data baru untuk grafik produk
        ));
    }

    public function updateStatus(Request $request, Penjualan $penjualan)
    {
        // Validasi input
        $request->validate([
            'shipping_status' => 'required|string|in:processing,shipped,delivered,cancelled',
        ]);

        // Update status pengiriman pada model Penjualan
        $penjualan->shipping_status = $request->input('shipping_status');
        $penjualan->save();

        // Redirect kembali ke halaman daftar penjualan dengan pesan sukses
        return redirect()->route('data_jual.index')->with('success', 'Status pengiriman berhasil diperbarui.');
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
        $cart = session()->get('cart_penjualan', []);

        // Hapus item dengan ID produk tertentu dari session
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart_penjualan' => $cart]);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
}
