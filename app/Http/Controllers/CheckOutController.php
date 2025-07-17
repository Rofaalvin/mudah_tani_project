<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'delivery_method' => 'required|in:pickup,delivery',
            'shipping_address' => 'required_if:delivery_method,delivery|string|max:1000',
        ]);
        $today = now()->toDateString();

        $lastKodeHariIni = Penjualan::whereDate('tanggal', $today)
            ->where('kode_trx_jual', 'like', 'PB' . now()->format('Ymd') . '%')
            ->orderBy('kode_trx_jual', 'desc')
            ->first();

        if ($lastKodeHariIni) {
            $lastNumber = (int) substr($lastKodeHariIni->kode_trx_jual, -3); // Ambil 3 digit terakhir sebagai angka
            // edit ini untuk dpat melakukan test midtrans jika kode telah digunakan
            $newNumber = str_pad($lastNumber + 5, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi 3 digit
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
        $subtotal = 0;
        $items = [];
        foreach ($cart as $id => $item) {
            $harga = (int) $item['harga'];
            $quantity = (int) $item['quantity'];
            $item_subtotal = $harga * $quantity;
            $subtotal += $item_subtotal;
            $items[] = [
                'id_produk' => $id,
                'nama_produk' => $item['nama_produk'],
                'harga' => $harga,
                'quantity' => $quantity,
                'subtotal' => $item_subtotal,
            ];
        }

        // Hitung total dengan biaya pengiriman jika ada
        $deliveryMethod = $request->input('delivery_method');
        $shippingCost = ($deliveryMethod === 'delivery') ? 12000 : 0;

        // Total keseluruhan
        $finalTotal = $subtotal + $shippingCost;

        // Simpan transaksi ke tabel Penjualan
        $transaction = Penjualan::create([
            'kode_trx_jual' => $lastKodeHariIni,
            'id_pembeli' => auth()->id(),
            'total' => $finalTotal,
            'total_final' => $finalTotal,
            'tanggal' => now()->toDateString(),
            'status' => 'pending',
            'delivery_method' => $deliveryMethod,
            'shipping_cost' => $shippingCost,
            'shipping_address' => $request->input('shipping_address'),
            'shipping_status' => 'pending',
            'from_cashier' => false,
        ]);

        // Simpan detail item ke tabel PenjualanItem
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
                'gross_amount' => $finalTotal,
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

        $penjualan->update([
            'status' => 'paid',
            'shipping_status' => 'processing',
        ]);

        $transaction = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->where('status', 'paid')
            ->orderBy('updated_at', 'desc')
            ->first();

        return view('user.payment.success', compact('transaction'));
    }
}
