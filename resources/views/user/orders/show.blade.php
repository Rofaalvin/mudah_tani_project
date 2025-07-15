<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('my.orders.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Orders
                </a>
                <div class="h-6 border-l border-gray-300"></div>
                <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                    Order #{{ $order->kode_trx_jual }}
                </h2>
            </div>

            <!-- Status Badge -->
            <div class="flex items-center space-x-3">
                @if ($order->status == 'pending')
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Pending Payment
                    </span>
                @elseif($order->status == 'paid')
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Paid
                    </span>
                @elseif($order->status == 'shipped')
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Shipped
                    </span>
                @elseif($order->status == 'delivered')
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Delivered
                    </span>
                @else
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {{ ucfirst($order->status) }}
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Details Section -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Information -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Order Information
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Order ID</label>
                                        <p class="text-lg font-semibold text-gray-900 font-mono">
                                            {{ $order->kode_trx_jual }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Order Date</label>
                                        <p class="text-gray-900">
                                            {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Total Items</label>
                                        <p class="text-gray-900">{{ $order->items->count() }} items</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Order Status</label>
                                        <p class="text-gray-900 capitalize">{{ $order->status }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Total Amount</label>
                                        <p class="text-2xl font-bold text-green-600">Rp
                                            {{ number_format($order->total, 0, ',', '.') }}</p>
                                    </div>
                                    @if ($order->snap_token)
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Payment Token</label>
                                            <p class="text-xs text-gray-600 font-mono bg-gray-50 p-2 rounded">
                                                {{ substr($order->snap_token, 0, 20) }}...</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($order->delivery_method == 'delivery' && $order->shipping_address)
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Shipping Address</label>
                                    <p class="text-gray-900">
                                        {{ $order->shipping_address }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Order Items ({{ $order->items->count() }})
                            </h3>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @foreach ($order->items as $item)
                                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                                {{ $item->nama_produk }}
                                            </h4>

                                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-600">
                                                <div class="flex items-center">
                                                    <span class="font-medium">Unit Price:</span>
                                                    <span class="ml-2 text-blue-600 font-semibold">
                                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="font-medium">Quantity:</span>
                                                    <span class="ml-2 bg-gray-100 px-2 py-1 rounded-md font-semibold">
                                                        {{ $item->quantity }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="font-medium">Subtotal:</span>
                                                    <span class="ml-2 text-green-600 font-bold">
                                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ml-4 flex-shrink-0">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Order Summary
                            </h3>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp
                                    {{ number_format($order->items->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>

                            @if (isset($order->tax_amount) && $order->tax_amount > 0)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Tax</span>
                                    <span class="font-medium">Rp
                                        {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            @if (isset($order->shipping_cost) && $order->shipping_cost > 0)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Shipping</span>
                                    <span class="font-medium">Rp
                                        {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            @if (isset($order->discount_amount) && $order->discount_amount > 0)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Discount</span>
                                    <span class="font-medium text-red-600">-Rp
                                        {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <hr class="border-gray-200">

                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-green-600">Rp
                                    {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    @if ($order->status == 'pending' && $order->snap_token)
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <div
                                class="px-6 py-4 bg-gradient-to-r from-yellow-50 to-orange-50 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Payment Required
                                </h3>
                            </div>

                            <div class="p-6">
                                <p class="text-sm text-gray-600 mb-4">
                                    Complete your payment to process this order.
                                </p>

                                <button id="pay-button"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Customer Information -->
                    @if (isset($order->customer))
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-blue-50 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    Customer Information
                                </h3>
                            </div>

                            <div class="p-6 space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Name</label>
                                    <p class="text-gray-900">{{ $order->customer->name ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email</label>
                                    <p class="text-gray-900">{{ $order->customer->email ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-500">Phone</label>
                                    <p class="text-gray-900">{{ $order->customer->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                        <div class="p-6 space-y-3">
                            @if ($order->status == 'paid')
                                <button
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Mark as Shipped
                                </button>
                            @endif

                            @if ($order->status == 'shipped')
                                <button
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Mark as Delivered
                                </button>
                            @endif

                            <a href="{{ route('my.orders.invoice.download', $order) }}" target="_blank"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H9.414a1 1 0 01-.707-.293l-2-2A1 1 0 005.586 6H4a2 2 0 00-2 2v4a2 2 0 002 2h2m5 4v6a1 1 0 001 1h4a1 1 0 001-1v-6a1 1 0 00-1-1h-4a1 1 0 00-1 1z">
                                    </path>
                                </svg>
                                Print Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($order->status == 'pending' && $order->snap_token)
        <!-- Midtrans Script -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                snap.pay('{{ $order->snap_token }}', {
                    onSuccess: function(result) {
                        alert("Payment success!");
                        window.location.reload();
                    },
                    onPending: function(result) {
                        alert("Waiting for your payment!");
                    },
                    onError: function(result) {
                        alert("Payment failed!");
                    }
                });
            };
        </script>
    @endif
</x-app-layout>
