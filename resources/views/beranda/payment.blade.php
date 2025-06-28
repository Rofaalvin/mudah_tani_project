<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Payment') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Order Created</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($transaction)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Transaction Details Section -->
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
                                                {{ $transaction->kode_trx_jual }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Order Date</label>
                                            <p class="text-gray-900">
                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Status</label>
                                            <div class="flex items-center mt-1">
                                                @if ($transaction->status == 'pending')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Pending Payment
                                                    </span>
                                                @elseif($transaction->status == 'paid')
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
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Total Amount</label>
                                            <p class="text-2xl font-bold text-green-600">Rp
                                                {{ number_format($transaction->total, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($transaction->delivery_method == 'delivery' && $transaction->shipping_address)
                                    <div>
                                        <label class="text-sm font-medium text-gray-500">Shipping Address</label>
                                        <p class="text-gray-900">
                                            {{ $transaction->shipping_address }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <div
                                class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Order Items ({{ $transaction->items->count() }})
                                </h3>
                            </div>

                            <div class="divide-y divide-gray-100">
                                @foreach ($transaction->items as $item)
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                                    {{ $item->nama_produk }}
                                                </h4>

                                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                                    <div class="flex items-center">
                                                        <span class="font-medium">Unit Price:</span>
                                                        <span class="ml-1 text-blue-600 font-semibold">
                                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span class="font-medium">Quantity:</span>
                                                        <span
                                                            class="ml-1 bg-gray-100 px-2 py-1 rounded-md font-semibold">
                                                            {{ $item->quantity }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <span class="font-medium">Subtotal:</span>
                                                        <span class="ml-1 text-green-600 font-bold">
                                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 sticky top-4">
                            <div
                                class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-100 rounded-t-2xl">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                    Payment Details
                                </h3>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Subtotal ({{ $transaction->items->count() }} items)</span>
                                        @php
                                            $subtotal = $transaction->total - $transaction->shipping_cost;
                                        @endphp
                                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>

                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Shipping Cost</span>
                                        @if ($transaction->shipping_cost > 0)
                                            <span class="font-medium">Rp
                                                {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                                        @else
                                            <span class="font-medium text-green-600">Free</span>
                                        @endif
                                    </div>

                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Tax</span>
                                        <span>Included</span>
                                    </div>

                                    <hr class="border-gray-200">

                                    <div class="flex justify-between items-center text-lg font-bold text-gray-900">
                                        <span>Total Payment</span>
                                        <span class="text-2xl text-purple-600">
                                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                @if ($transaction->status == 'pending')
                                    <div class="pt-4">
                                        <button id="pay-button"
                                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group">
                                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                            Pay Now
                                        </button>
                                    </div>
                                @else
                                    <div class="pt-4">
                                        <div
                                            class="w-full bg-gray-100 text-gray-500 font-semibold py-4 px-6 rounded-xl text-center">
                                            Payment {{ ucfirst($transaction->status) }}
                                        </div>
                                    </div>
                                @endif

                                <div class="pt-2 text-center">
                                    <div class="flex items-center justify-center text-xs text-gray-500 space-x-4">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span>Secure Payment</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>Protected Transaction</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Back to Shopping -->
                        <div class="mt-6">
                            <a href="{{ route('product.index') }}"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-xl transition-colors duration-200 flex items-center justify-center text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Transaction Found -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="text-center py-16 px-6">
                        <div class="mb-6">
                            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Transaction Found</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            We couldn't find any transaction to process. Please create an order first.
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

    @if ($transaction && $transaction->status == 'pending')
        <!-- Midtrans Snap JS -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('{{ $transaction->snap_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        alert("Payment success!");
                        window.location.href = "{{ route('user.payment.success', $transaction->id) }}";
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        alert("Waiting for your payment!");
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        alert("Payment failed!");
                    }
                });
            };
        </script>
    @endif
</x-app-layout>
