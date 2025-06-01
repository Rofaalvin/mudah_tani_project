<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Overview</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- @php
                // Get order statistics for current user
                $totalOrders = App\Models\Penjualan::where('id_pembeli', auth()->id())->count();
                $pendingOrders = App\Models\Penjualan::where('id_pembeli', auth()->id())
                    ->where('status', 'pending')->count();
                $paidOrders = App\Models\Penjualan::where('id_pembeli', auth()->id())
                    ->where('status', 'paid')->count();
                $totalSpent = App\Models\Penjualan::where('id_pembeli', auth()->id())
                    ->where('status', 'paid')
                    ->sum('total');
                
                // Get recent transactions
                $recentTransactions = App\Models\Penjualan::with('items')
                    ->where('id_pembeli', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();
            @endphp --}}

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Orders -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                            </div>
                            <div class="bg-blue-50 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-gray-600">
                            <span>All time orders</span>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Pending Orders</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $pendingOrders }}</p>
                            </div>
                            <div class="bg-yellow-50 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-gray-600">
                            <span>Awaiting payment</span>
                        </div>
                    </div>
                </div>

                <!-- Paid Orders -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Paid Orders</p>
                                <p class="text-3xl font-bold text-green-600">{{ $paidOrders }}</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-gray-600">
                            <span>Successfully paid</span>
                        </div>
                    </div>
                </div>

                <!-- Total Spent -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Total Spent</p>
                                <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-purple-50 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-gray-600">
                            <span>From paid orders</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Transactions -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Recent Transactions
                            </h3>
                        </div>
                        
                        @if($recentTransactions->count() > 0)
                            <div class="divide-y divide-gray-100">
                                @foreach($recentTransactions as $transaction)
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3 mb-2">
                                                    <h4 class="text-sm font-mono font-semibold text-gray-900">
                                                        {{ $transaction->kode_trx_jual }}
                                                    </h4>
                                                    @if($transaction->status == 'pending')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                            Pending
                                                        </span>
                                                    @elseif($transaction->status == 'paid')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Paid
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                            {{ ucfirst($transaction->status) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                    <span>{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</span>
                                                    <span>•</span>
                                                    <span>{{ $transaction->items->count() }} item(s)</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-semibold text-gray-900">
                                                    Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                                </p>
                                                @if($transaction->status == 'pending')
                                                    <a 
                                                    href="{{ route('order.payment', parameters: $transaction->id) }}" 
                                                    class="text-sm text-purple-600 hover:text-purple-700 font-medium">
                                                        Pay Now →
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <a 
                                href="{{ route('my.orders.index') }}" 
                                class="text-sm text-indigo-600 hover:text-indigo-700 font-medium flex items-center justify-center">
                                    View All Transactions
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-12 px-6">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Transactions Yet</h3>
                                <p class="text-gray-500 mb-6">Start shopping to see your transaction history here.</p>
                                <a href="{{ route('product.index') }}" 
                                   class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Start Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Quick Actions
                            </h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Browse Products -->
                            <a 
                            href="{{ route('product.index') }}" 
                               class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 flex items-center group shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Browse Products
                            </a>

                            <!-- View Cart -->
                            <a 
                            href="{{ route('checkout.index') }}" 
                               class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 flex items-center group shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v8a2 2 0 01-2 2H9a2 2 0 01-2-2v-8m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                                View Cart
                            </a>

                            @if($pendingOrders > 0)
                                <!-- Complete Payment -->
                                <a 
                                href="{{ route('my.orders.index') }}" 
                                   class="w-full bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 flex items-center group shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Complete Payment
                                    <span class="ml-auto bg-white bg-opacity-20 text-xs px-2 py-1 rounded-full">
                                        {{ $pendingOrders }}
                                    </span>
                                </a>
                            @endif

                            <!-- Order History -->
                            <a 
                            href="{{ route('my.orders.history') }}" 
                               class="w-full bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-200 flex items-center group shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Order History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>