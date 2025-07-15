<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    /**
     * Menampilkan riwayat pesanan dengan fungsionalitas pencarian dan filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function history(Request $request)
    {
        // Memulai query untuk model Penjualan
        $query = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->where('status', '!=', 'pending');

        // Filter berdasarkan kata kunci (Kode Transaksi)
        if ($request->filled('search')) {
            $query->where('kode_trx_jual', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        // Mengurutkan dan mengambil hasil
        $orders = $query->orderBy('created_at', 'desc')->get();

        // Mengembalikan view dengan data pesanan yang telah difilter
        return view('user.orders.history', compact('orders'));
    }

    public function downloadInvoice(Penjualan $order)
    {
        // Pastikan pengguna hanya bisa mendownload invoice miliknya sendiri
        if (auth()->id() != $order->id_pembeli) {
            abort(403, 'Unauthorized action.');
        }

        // Data yang akan dikirim ke view invoice
        $data = ['order' => $order];

        // Load view dan data, lalu buat PDF
        $pdf = Pdf::loadView('invoices.show', $data);
        
        // Atur nama file PDF yang akan didownload
        $filename = 'invoice-' . $order->kode_trx_jual . '.pdf';

        // Download file PDF
        return $pdf->download($filename);
    }
}