<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function products()
    {
        $produks = Produk::all();
        $cartCount = 0;
        if (session()->has('cart')) {
            $cart = session('cart');
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }
        // dd($cartCount);
        return view('user.products.index', compact('produks', 'cartCount'));
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
        return view('beranda.checkout');
    }
}
