<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function history()
    {
        $orders = Penjualan::with('items')
            ->where('id_pembeli', auth()->id())
            ->where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.orders.history', compact('orders'));
    }
}