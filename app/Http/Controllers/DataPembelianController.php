<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use Carbon\Carbon;

class DataPembelianController extends Controller
{
    /**
     * Menampilkan data pembelian dengan filter bulan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil nilai filter dari request (format: YYYY-MM)
        $filterBulan = $request->input('filter_bulan');

        // Mulai query ke model Pembelian dengan relasi
        $query = Pembelian::with('supplyer')->latest('tanggal');

        // Jika ada filter bulan yang diterapkan
        if ($filterBulan) {
            try {
                // Parse string YYYY-MM menjadi objek Carbon
                $date = Carbon::createFromFormat('Y-m', $filterBulan);
                // Terapkan filter berdasarkan tahun dan bulan dari tanggal pembelian
                $query->whereYear('tanggal', $date->year)
                    ->whereMonth('tanggal', $date->month);
            } catch (\Exception $e) {
                // Jika format tidak valid, abaikan filter untuk mencegah error
            }
        }

        // Lakukan paginasi dan pastikan link paginasi menyertakan query filter
        $data_pembelian = $query->paginate(10)->appends($request->query());

        // Kirim data ke view, termasuk nilai filter saat ini untuk ditampilkan di form
        return view('admin.data_pembelian.index', compact('data_pembelian', 'filterBulan'));
    }
}
