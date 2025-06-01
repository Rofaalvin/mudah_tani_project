<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function process(Request $request)
    {
        $today = now()->toDateString();

        $lastKodeHariIni = Penjualan::whereDate('tanggal', $today)
            ->where('kode_trx_jual', 'like', 'PB' . now()->format('Ymd') . '%')
            ->orderBy('kode_trx_jual', 'desc')
            ->first();

        if ($lastKodeHariIni) {
            $lastNumber = (int) substr($lastKodeHariIni->kode_trx_jual, -3); // Ambil 3 digit terakhir sebagai angka
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi 3 digit
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . $newNumber; // Gabungkan dengan tanggal
        } else {
            $lastKodeHariIni = 'PB' . now()->format('Ymd') . '001';
        }
        // Ambil cart dari session
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung total dan siapkan data item
        $total_amount = 0;
        $items = [];
        foreach ($cart as $id => $item) {
            $harga = (int) $item['harga'];
            $quantity = (int) $item['quantity'];
            $subtotal = $harga * $quantity;
            $total_amount += $subtotal;
            $items[] = [
                'id_produk' => $id,
                'nama_produk' => $item['nama_produk'],
                'harga' => $harga,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        // Simpan transaksi ke tabel Penjualan
        $transaction = Penjualan::create([
            'kode_trx_jual' => $lastKodeHariIni,
            'id_pembeli' => auth()->id(),
            'total' => $total_amount,
            'tanggal' => now()->toDateString(),
            'status' => 'pending',
        ]);

        // Simpan detail item ke tabel PenjualanItem (pastikan model & relasi sudah ada)
        foreach ($items as $item) {
            $transaction->items()->create([
                'id_produk' => $item['id_produk'],
                'nama_produk' => $item['nama_produk'],
                'harga' => $item['harga'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['subtotal'],
            ]);
            $produk = Produk::find($item['id_produk']);
            if ($produk) {
                $produk->stok = max(0, $produk->stok - $item['quantity']);
                $produk->save();
            }
        }

        session()->forget('cart');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $lastKodeHariIni,
                'gross_amount' => $total_amount,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        return redirect()->route('order.payment', ['id' => $transaction->id])->with('success', 'Pesanan berhasil diproses!');
    }

    public function payment($id)
    {
        $transaction = Penjualan::with('items')
            ->where('id', $id)
            ->where('id_pembeli', auth()->id())
            ->first();

        if (!$transaction) {
            return redirect()->route('beranda.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('beranda.payment', compact('transaction'));
    }

    public function success(Penjualan $penjualan)
    {
        // dd($penjualan->id_pembeli, auth()->id());
        // Pastikan transaksi milik user yang sedang login
        if ($penjualan->id_pembeli != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $penjualan->update(['status' => 'paid']);

        $transaction = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->where('status', 'paid')
            ->orderBy('updated_at', 'desc')
            ->first();

        return view('user.payment.success', compact('transaction'));
    }
}
