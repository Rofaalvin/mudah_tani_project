<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Statistik pesanan
        $totalOrders = Penjualan::where('id_pembeli', $userId)->count();
        $pendingOrders = Penjualan::where('id_pembeli', $userId)
            ->where('status', 'pending')->count();
        $paidOrders = Penjualan::where('id_pembeli', $userId)
            ->where('status', 'paid')->count();
        $totalSpent = Penjualan::where('id_pembeli', $userId)
            ->where('status', 'paid')
            ->sum('total');

        // Transaksi terbaru
        $recentTransactions = Penjualan::with('items')
            ->where('id_pembeli', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'paidOrders',
            'totalSpent',
            'recentTransactions'
        ));
    }
}
