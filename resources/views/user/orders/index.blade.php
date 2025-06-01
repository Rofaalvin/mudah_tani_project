<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('My Orders') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="font-medium">{{ $orders->count() }} Orders</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($orders->count() > 0)
                <!-- Filter/Search Bar -->
                {{-- <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 2v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Filter by Status:</span>
                            </div>
                            <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Orders</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center space-x-2 text-sm text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Showing {{ $orders->count() }} orders</span>
                        </div>
                    </div>
                </div> --}}

                <!-- Orders List -->
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <!-- Order Header -->
                            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-100">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                Order #{{ $order->kode_trx_jual }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Placed on
                                                {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <!-- Status Badge -->
                                        @if ($order->status == 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Pending Payment
                                            </span>
                                        @elseif($order->status == 'paid')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Paid
                                            </span>
                                        @elseif($order->status == 'shipped')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                    </path>
                                                </svg>
                                                Shipped
                                            </span>
                                        @elseif($order->status == 'delivered')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Delivered
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif

                                        <!-- Total Amount -->
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-gray-900">
                                                Rp {{ number_format($order->total, 0, ',', '.') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $order->items->count() }} items
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        @php
                                            $displayItems = $order->items->take(3);
                                            $remainingCount = $order->items->count() - 3;
                                        @endphp

                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700">Items:</span>
                                        </div>

                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($displayItems as $item)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ $item->nama_produk }}
                                                    @if ($item->quantity > 1)
                                                        <span
                                                            class="ml-1 bg-gray-300 text-gray-700 px-1.5 py-0.5 rounded-full text-xs">
                                                            {{ $item->quantity }}
                                                        </span>
                                                    @endif
                                                </span>
                                            @endforeach

                                            @if ($remainingCount > 0)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    +{{ $remainingCount }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        @if ($order->status == 'pending')
                                            <a href="{{ route('order.payment', ['id' => $order->id]) }}"
                                                class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg>
                                                Pay Now
                                            </a>
                                        @endif

                                        <a href="{{ route('my.orders.show', $order->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button (if needed) -->
                <div class="mt-8 text-center">
                    <button
                        class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Load More Orders
                    </button>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="text-center py-16 px-6">
                        <div class="mb-6">
                            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Orders Yet</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            You haven't placed any orders yet. Start shopping to see your order history here.
                        </p>
                        <a {{-- href="{{ route('products.index') }}"  --}}
                            class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
