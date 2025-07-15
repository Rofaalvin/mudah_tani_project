<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BerandaController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $cartCount = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }
        // dd($cartCount);
        return view('beranda.index', compact('produks', 'cartCount'));
    }

    public function products(Request $request) // 2. Tambahkan Request $request
    {
        // 3. Ambil input pencarian dari request
        $search = $request->input('search');

        // 4. Mulai query builder, jangan langsung ambil semua data
        $query = Produk::query();

        // 5. Jika ada input pencarian, tambahkan kondisi 'where'
        if ($search) {
            // Cari produk yang namanya mengandung kata kunci pencarian
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        // 6. Eksekusi query untuk mendapatkan produk yang sudah difilter
        $produks = $query->get();

        // Logika untuk cart count tetap sama
        $cartCount = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }
        
        // 7. Kirim semua data yang dibutuhkan ke view, termasuk variabel $search
        return view('user.products.index', compact('produks', 'cartCount', 'search'));
    }

    public function add(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'gambar' => $produk->gambar,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Jika request AJAX, balikan JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cartCount' => $cartCount
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function cartList()
    {
        $cart = session('cart', []);
        return response()->json($cart);
    }

    public function update(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id' => 'required',
                'quantity' => 'required|integer|min:0|max:999'
            ]);

            $productId = $request->id;
            $quantity = (int) $request->quantity;

            // Ambil cart dari session
            $cart = session()->get('cart', []);

            // Cek apakah produk ada di cart
            if (!isset($cart[$productId])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang.'
                ], 404);
            }

            // Jika quantity <= 0, hapus item dari cart
            if ($quantity <= 0) {
                unset($cart[$productId]);
                $message = 'Item berhasil dihapus dari keranjang.';
            } else {
                // Update quantity
                $cart[$productId]['quantity'] = $quantity;
                $message = 'Keranjang berhasil diperbarui.';
            }

            // Simpan cart yang sudah diupdate ke session
            session()->put('cart', $cart);

            // Hitung ulang total quantity dan total price
            $cartCount = 0;
            $totalPrice = 0;

            foreach ($cart as $item) {
                $cartCount += $item['quantity'];
                $totalPrice += $item['quantity'] * $item['harga'];
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'cartCount' => $cartCount,
                'totalPrice' => $totalPrice,
                'cartData' => $cart
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating cart: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui keranjang.'
            ], 500);
        }
    }

    public function checkout()
{
    // Dapatkan data pengguna yang sedang login
    $user = auth()->user();

    // Prioritas 1: Cari alamat dari kolom 'address' di tabel 'users'.
    // Menggunakan !empty() untuk memastikan kolom tidak null atau string kosong.
    $shippingAddress = !empty($user->alamat) ? $user->alamat : null;

    // Prioritas 2: Jika alamat di tabel 'users' kosong,
    // maka cari 'shipping_address' dari pesanan terakhir.
    if (is_null($shippingAddress)) {
        // Cari pesanan terakhir dari pengguna yang memiliki alamat pengiriman.
        $lastOrderWithAddress = Penjualan::where('id_pembeli', $user->id)
            ->whereNotNull('shipping_address')
            ->where('shipping_address', '!=', '')
            ->latest() // Mengurutkan dari yang terbaru
            ->first();

        // Ambil alamatnya jika pesanan ditemukan.
        $shippingAddress = $lastOrderWithAddress ? $lastOrderWithAddress->shipping_address : null;
    }
    
    // Kirim data alamat yang ditemukan ke view.
    return view('beranda.checkout', [
        'lastShippingAddress' => $shippingAddress
    ]);
}
}
