<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Order History') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-purple-600 bg-purple-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <span class="font-medium">All Orders</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Navigation -->
            {{-- <div class="mb-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Back to Dashboard
                </a>
            </div> --}}

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 mb-8">
                <form action="{{ route('my.orders.history') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        <div class="md:col-span-2 lg:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700">Search by Code</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="e.g. TRX-12345" value="{{ request('search') }}">
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="all" @selected(request('status') == 'all')>All</option>
                                <option value="paid" @selected(request('status') == 'paid')>Paid</option>
                                <option value="cancelled" @selected(request('status') == 'cancelled')>Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">From Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">To Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-end space-x-3">
                        <a href="{{ route('my.orders.history') }}"
                            class="text-sm font-medium text-gray-600 hover:text-indigo-600">Reset Filters</a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>

            @if ($orders->count() > 0)
                <!-- Summary Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Completed Orders -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Completed Orders</p>
                                    <p class="text-3xl font-bold text-green-600">
                                        {{ $orders->where('status', 'paid')->count() }}</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Amount Spent -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Total Spent</p>
                                    <p class="text-2xl font-bold text-purple-600">Rp
                                        {{ number_format($orders->where('status', 'paid')->sum('total'), 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="bg-purple-50 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Average Order Value -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Average Order</p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        Rp
                                        {{ $orders->where('status', 'paid')->count() > 0 ? number_format($orders->where('status', 'paid')->avg('total'), 0, ',', '.') : '0' }}
                                    </p>
                                </div>
                                <div class="bg-blue-50 p-3 rounded-xl">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            All Order History ({{ $orders->count() }} orders)
                        </h3>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach ($orders as $order)
                            <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                <div
                                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                                    <!-- Order Info -->
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-3">
                                            <h4 class="text-lg font-mono font-bold text-gray-900">
                                                {{ $order->kode_trx_jual }}
                                            </h4>
                                            @if ($order->status == 'paid')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Paid
                                                </span>
                                            @elseif($order->status == 'cancelled')
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Cancelled
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-600 mb-4">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v1a1 1 0 01-1 1H10a1 1 0 01-1-1V9a2 2 0 012-2h3zM8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2">
                                                    </path>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                </svg>
                                                <span>{{ $order->items->count() }} item(s)</span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</span>
                                            </div>
                                        </div>

                                        <!-- Order Items Preview -->
                                        @if ($order->items->count() > 0)
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <h5 class="text-sm font-medium text-gray-700 mb-2">Items:</h5>
                                                <div class="space-y-1">
                                                    @foreach ($order->items->take(3) as $item)
                                                        <div class="flex justify-between items-center text-sm">
                                                            <span
                                                                class="text-gray-600">{{ $item->nama_produk ?? 'Product' }}</span>
                                                            <span class="text-gray-500">{{ $item->quantity }}x - Rp
                                                                {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if ($order->items->count() > 3)
                                                        <div class="text-xs text-gray-400 italic">
                                                            +{{ $order->items->count() - 3 }} more items...
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Order Total & Actions -->
                                    <div class="lg:text-right lg:ml-6">
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                                            <p class="text-2xl font-bold text-gray-900">
                                                Rp {{ number_format($order->total, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="flex lg:flex-col space-x-2 lg:space-x-0 lg:space-y-2">
                                            <!-- View Details Button -->
                                            <button onclick="toggleOrderDetails('order-{{ $order->id }}')"
                                                class="flex-1 lg:flex-none px-4 py-2 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-sm font-medium rounded-lg transition-colors duration-200">
                                                View Details
                                            </button>

                                            @if ($order->status == 'paid')
                                                <a href="{{ route('my.orders.invoice.download', $order) }}"
                                                    class="flex-1 lg:flex-none text-center px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium rounded-lg transition-colors duration-200">
                                                    Download Invoice
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Collapsible Order Details -->
                                <div id="order-{{ $order->id }}"
                                    class="hidden mt-6 pt-6 border-t border-gray-200">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Detailed Items List -->
                                        <div>
                                            <h6 class="font-semibold text-gray-900 mb-3">Order Items</h6>
                                            <div class="space-y-3">
                                                @foreach ($order->items as $item)
                                                    <div
                                                        class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                                        <div>
                                                            <p class="font-medium text-gray-900">
                                                                {{ $item->nama_produk ?? 'Product' }}</p>
                                                            <p class="text-sm text-gray-500">Quantity:
                                                                {{ $item->quantity }}</p>
                                                            <p class="text-sm text-gray-500">Unit Price: Rp
                                                                {{ number_format($item->harga, 0, ',', '.') }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="font-semibold text-gray-900">
                                                                Rp
                                                                {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Order & Shipping Summary -->
                                        <div>
                                            <h6 class="font-semibold text-gray-900 mb-3">Order & Shipping Summary</h6>
                                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                                {{-- ... Ringkasan pesanan (tanggal, kode, status bayar) ... --}}
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-600">Delivery Method:</span>
                                                    <span
                                                        class="font-medium capitalize">{{ $order->delivery_method }}</span>
                                                </div>

                                                {{-- TAMPILKAN STATUS PENGIRIMAN JIKA DELIVERY --}}
                                                @if ($order->delivery_method == 'delivery')
                                                    <div class="border-t border-gray-200 pt-3">
                                                        <p class="text-sm font-medium text-gray-800 mb-2">Shipping
                                                            Status:</p>
                                                        @php
                                                            // Logika untuk menentukan langkah mana yang aktif
                                                            $isProcessing = in_array($order->shipping_status, [
                                                                'processing',
                                                                'shipped',
                                                                'delivered',
                                                            ]);
                                                            $isShipped = in_array($order->shipping_status, [
                                                                'shipped',
                                                                'delivered',
                                                            ]);
                                                            $isDelivered = $order->shipping_status == 'delivered';
                                                        @endphp
                                                        <div class="flex items-center space-x-2 text-xs">
                                                            <!-- Step 1: Processing -->
                                                            <div class="flex flex-col items-center">
                                                                <div
                                                                    class="w-6 h-6 rounded-full flex items-center justify-center {{ $isProcessing ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                                                    <svg class="w-4 h-4" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12zM9 9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm1-4a1 1 0 100 2 1 1 0 000-2z" />
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="mt-1 {{ $isProcessing ? 'font-semibold text-blue-600' : 'text-gray-500' }}">Processing</span>
                                                            </div>
                                                            <!-- Connector -->
                                                            <div
                                                                class="flex-1 h-0.5 {{ $isShipped ? 'bg-blue-600' : 'bg-gray-200' }}">
                                                            </div>
                                                            <!-- Step 2: Shipped -->
                                                            <div class="flex flex-col items-center">
                                                                <div
                                                                    class="w-6 h-6 rounded-full flex items-center justify-center {{ $isShipped ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                                                    <svg class="w-4 h-4" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M8 16.5a.5.5 0 01-.5-.5V9.707l-1.146 1.147a.5.5 0 01-.708-.708l2-2a.5.5 0 01.708 0l2 2a.5.5 0 01-.708.708L8.5 9.707V16.5a.5.5 0 01-.5.5z M4.5 9.5a.5.5 0 01-.5-.5v-2a.5.5 0 01.5-.5h7a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-7z" />
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="mt-1 {{ $isShipped ? 'font-semibold text-blue-600' : 'text-gray-500' }}">Shipped</span>
                                                            </div>
                                                            <!-- Connector -->
                                                            <div
                                                                class="flex-1 h-0.5 {{ $isDelivered ? 'bg-blue-600' : 'bg-gray-200' }}">
                                                            </div>
                                                            <!-- Step 3: Delivered -->
                                                            <div class="flex flex-col items-center">
                                                                <div
                                                                    class="w-6 h-6 rounded-full flex items-center justify-center {{ $isDelivered ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                                                    <svg class="w-4 h-4" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </div>
                                                                <span
                                                                    class="mt-1 {{ $isDelivered ? 'font-semibold text-green-600' : 'text-gray-500' }}">Delivered</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Order Summary -->
                                        <div>
                                            <h6 class="font-semibold text-gray-900 mb-3">Order Summary</h6>
                                            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-600">Order Date:</span>
                                                    <span
                                                        class="font-medium">{{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y, H:i') }}</span>
                                                </div>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-600">Transaction Code:</span>
                                                    <span
                                                        class="font-mono font-medium">{{ $order->kode_trx_jual }}</span>
                                                </div>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-600">Payment Status:</span>
                                                    <span class="font-medium capitalize">{{ $order->status }}</span>
                                                </div>
                                                <div class="border-t border-gray-200 pt-2 mt-3">
                                                    <div class="flex justify-between">
                                                        <span class="font-semibold text-gray-900">Total Amount:</span>
                                                        <span class="font-bold text-lg text-gray-900">Rp
                                                            {{ number_format($order->total, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Orders Found</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        We couldn't find any orders matching your search criteria. Try adjusting your filters or search
                        term.
                    </p>
                    <a href="{{ route('my.orders.history') }}"
                        class="inline-flex items-center bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-6 rounded-xl border border-gray-300 shadow-sm hover:shadow-md transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h5">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12A8 8 0 0112 20a8 8 0 01-8-8"></path>
                        </svg>
                        Reset and View All Orders
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript for Toggle Details -->
    <script>
        function toggleOrderDetails(orderId) {
            const element = document.getElementById(orderId);
            const isVisible = !element.classList.contains('hidden');

            if (isVisible) {
                element.classList.add('hidden');
            } else {
                element.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
