<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Supplyer;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembelianController extends Controller
{
    public function index()
    {
        // Mendapatkan tanggal hari ini dalam format Y-m-d
        $today = now()->toDateString();

        // Mencari kode transaksi pembelian terakhir hari ini
        $lastKodeHariIni = Pembelian::whereDate('tanggal', $today)
            ->where('kode_trx_beli', 'like', 'PB' . now()->format('Ymd') . '%')
            ->orderBy('kode_trx_beli', 'desc')
            ->first();

        // Menentukan kode transaksi terakhir
        if ($lastKodeHariIni) {
            // Increment kode transaksi terakhir
            $lastNumber = (int) substr($lastKodeHariIni->kode_trx_beli, -3); // Ambil 3 digit terakhir sebagai angka
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi 3 digit
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . $newNumber; // Gabungkan dengan tanggal
        } else {
            // Jika tidak ada transaksi, mulai dari angka 001
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . '001';
        }

        // Mengambil data pembelian dan suppliers
        $pembelian = Pembelian::with('supplyer')->get();
        $items = session()->get('pembelian_items', []);
        $suppliers = Supplyer::all();
        $produks = Produk::all();
        $selectedSupplyer = session('selected_supplyer');

        // Kirim data ke view
        return view('penjual.pembelian.index', compact('pembelian', 'items', 'suppliers', 'selectedSupplyer', 'lastKodeHariIni', 'produks'));
    }


    public function deleteItem($id)
    {
        $items = session()->get('pembelian_items', []);
        $items = array_filter($items, fn($item) => $item['id'] != $id);
        session()->put('pembelian_items', $items);

        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }

    public function clearAll()
    {
        session()->forget(['cart_pembelian', 'id_supplyer', 'selected_supplyer']);
        return redirect()->back()->with('success', 'Semua item berhasil dihapus.');
    }

    public function setSupplyer(Request $request)
    {
        $request->validate([
            'id_supplyer' => 'required|exists:supplyer,id_supplyer',
        ]);

        // dd($request->id_supplyer);

        session(['id_supplyer' => $request->id_supplyer]);
        session(['selected_supplyer' => Supplyer::find($request->id_supplyer)->nama_supplyer]);

        return response()->json(['message' => 'Supplyer berhasil disimpan dalam session.']);
    }


    public function storeFinal(Request $request)
    {
        // Validasi input baru
        $request->validate([
            'kode_trx_beli' => 'required|string',
            'diskon' => 'required|numeric|min:0',
            'total_final' => 'required|numeric|min:0',
        ]);

        $kodeTransaksi = $request->input('kode_trx_beli');
        $items = session()->get('cart_pembelian', []);
        $idSupplyer = session('id_supplyer');

        // Ambil data diskon dan total final dari request
        $diskon = $request->input('diskon');
        $totalFinal = $request->input('total_final');

        if (!$idSupplyer) {
            return redirect()->back()->with('error', 'Supplier belum dipilih.');
        }

        if (empty($items)) {
            return redirect()->back()->with('error', 'Tidak ada item dalam transaksi.');
        }

        foreach ($items as $item) {
            Pembelian::create([
                'kode_trx_beli' => $kodeTransaksi,
                'id_supplyer' => $idSupplyer,
                'id_barang' => $item['id_produk'],
                'nama_barang' => $item['nama_produk'],
                'quantity' => $item['jumlah'],
                'harga' => $item['harga_satuan'],
                'total' => $item['harga_satuan'] * $item['jumlah'], // Ini adalah subtotal per item
                'tanggal' => now(),
                'diskon' => $diskon,
                'total_final' => $totalFinal,
            ]);

            $produk = Produk::find($item['id_produk']);
            if ($produk) {
                $produk->stok += $item['jumlah'];
                $produk->save();
            }
        }

        session()->forget(['cart_pembelian', 'id_supplyer', 'selected_supplyer']);
        return redirect()->route('pembelian.index')->with('success', 'Transaksi pembelian berhasil disimpan.');
    }


    public function addItem(Request $request)
    {
        $item = [
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'harga_satuan' => (int) $request->harga_satuan,
            'jumlah' => (int) $request->jumlah,
        ];

        $cart = session()->get('cart_pembelian', []);
        $cart[$item['id_produk']] = $item;
        session(['cart_pembelian' => $cart]);

        return redirect()->back();
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart_pembelian', []);

        // Hapus item dengan ID produk tertentu dari session
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart_pembelian' => $cart]);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
    public function tambahItem(Request $request)
    {
        $item = [
            'id_produk' => $request->kode_barang,
            'nama_produk' => $request->nama_barang,
            'jumlah' => $request->qty,
            'harga_satuan' => $request->harga,
            'total' => $request->qty * $request->harga,
        ];

        $cart = session()->get('cart_pembelian', []);
        $cart[] = $item;
        session()->put('cart_pembelian', $cart);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan.');
    }
    public function simpanPembelian(Request $request)
    {
        $pembelianInfo = [
            'kode_trx_beli' => $request->kode_trx_beli,
            'nama_supplyer' => $request->nama_supplyer,
            'tanggal' => $request->tanggal,
        ];

        session()->put('pembelianInfo', $pembelianInfo);

        return redirect()->route('data_beli.index');
    }

    /**
     * Menampilkan data pembelian dengan fungsionalitas pencarian.
     */
    public function dataPembelian(Request $request)
    {
        // Set default filter bulan
        $filterBulan = $request->input('filter_bulan', now()->format('Y-m'));
        $search = $request->input('search', '');

        // Query untuk grafik (TANPA filter bulan - menampilkan semua data)
        $chartQuery = Pembelian::query();

        // Ambil data untuk grafik dari semua bulan (6 bulan terakhir sebagai contoh)
        $grafikData = $chartQuery
            ->select(
                DB::raw('DATE(tanggal) as tanggal_pembelian'),
                DB::raw('SUM(total_final) as total_harian')
            )
            ->where('tanggal', '>=', now()->subMonths(6)) // Ambil data 6 bulan terakhir
            ->groupBy('tanggal_pembelian')
            ->orderBy('tanggal_pembelian', 'asc')
            ->get();

        // Format data untuk Chart.js
        $chartLabels = $grafikData->pluck('tanggal_pembelian')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        });
        $chartData = $grafikData->pluck('total_harian');

        // Query untuk tabel data (dengan filter bulan dan pencarian)
        $tableQuery = Pembelian::query()->with('supplyer');

        // Terapkan filter bulan untuk tabel
        try {
            $date = Carbon::createFromFormat('Y-m', $filterBulan);
            $tableQuery->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month);
        } catch (\Exception $e) {
            // Jika format tidak valid, gunakan bulan saat ini
            $date = now();
            $tableQuery->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month);
        }

        // Terapkan pencarian jika ada
        if (!empty($search)) {
            $tableQuery->where(function ($query) use ($search) {
                $query->where('kode_trx_beli', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhereHas('supplyer', function ($q) use ($search) {
                        $q->where('nama_supplyer', 'like', "%{$search}%");
                    });
            });
        }

        // Ambil data dan kelompokkan berdasarkan kode transaksi
        $pembelianData = $tableQuery->orderBy('tanggal', 'desc')
            ->orderBy('kode_trx_beli', 'desc')
            ->get();

        // Kelompokkan data berdasarkan kode transaksi
        $pembelianItems = $pembelianData->groupBy('kode_trx_beli');

        // Kirim data ke view
        return view('penjual.data_beli.index', compact(
            'pembelianItems',
            'filterBulan',
            'search',
            'chartLabels',
            'chartData'
        ));
    }

    // public function dataBeli()
    // {
    //     // Mengambil semua data pembelian beserta detail dan supplier
    //     $pembelians = Pembelian::with(['supplyer', 'details.produk'])->orderBy('tanggal', 'desc')->get();
    //     return view('penjual.data_beli', compact('pembelians'));
    // }

}
