<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Payment Success') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">Payment Completed</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- @php
                // Get the latest paid transaction for current user
                $transaction = App\Models\Penjualan::with('items')
                    ->where('id_pembeli', auth()->id())
                    ->where('status', 'paid')
                    ->orderBy('updated_at', 'desc')
                    ->first();
            @endphp --}}

            @if ($transaction)
                <!-- Success Animation Container -->
                <div class="text-center mb-8">
                    <div class="relative inline-block">
                        <!-- Animated Success Circle -->
                        <div class="w-32 h-32 mx-auto mb-6 relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full animate-pulse">
                            </div>
                            <div class="absolute inset-2 bg-white rounded-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-green-500 animate-bounce" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="absolute -top-4 -left-8 w-8 h-8 bg-yellow-300 rounded-full opacity-60 animate-ping">
                        </div>
                        <div class="absolute -top-2 -right-6 w-6 h-6 bg-blue-300 rounded-full opacity-60 animate-ping"
                            style="animation-delay: 0.5s;"></div>
                        <div class="absolute -bottom-4 left-4 w-4 h-4 bg-pink-300 rounded-full opacity-60 animate-ping"
                            style="animation-delay: 1s;"></div>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Payment Successful! 🎉
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Thank you for your purchase! Your payment has been processed successfully and your order is now
                        being prepared.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Transaction Summary -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Payment Confirmation -->
                        <div
                            class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl shadow-xl border border-green-200 overflow-hidden">
                            <div
                                class="px-6 py-4 bg-gradient-to-r from-green-100 to-emerald-100 border-b border-green-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Payment Confirmation
                                </h3>
                            </div>

                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Transaction ID</label>
                                            <p class="text-lg font-semibold text-gray-900 font-mono">
                                                {{ $transaction->kode_trx_jual }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Payment Date</label>
                                            <p class="text-gray-900">
                                                {{ \Carbon\Carbon::parse($transaction->updated_at)->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Payment Method</label>
                                            <p class="text-gray-900">Online Payment</p>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Status</label>
                                            <div class="flex items-center mt-1">
                                                <span
                                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Payment Successful
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="text-sm font-medium text-gray-500">Amount Paid</label>
                                            <p class="text-3xl font-bold text-green-600">
                                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Your Order ({{ $transaction->items->count() }} items)
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
                                            <div class="ml-4 flex-shrink-0">
                                                <div
                                                    class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps & Actions -->
                    <div class="lg:col-span-1">
                        <div class="space-y-6">
                            <!-- What's Next -->
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
                                <div
                                    class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-100 rounded-t-2xl">
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        What's Next?
                                    </h3>
                                </div>

                                <div class="p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
                                                <span class="text-xs font-bold text-blue-600">1</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Order Processing</p>
                                                <p class="text-xs text-gray-500">We're preparing your order</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center mt-0.5">
                                                <span class="text-xs font-bold text-yellow-600">2</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Shipping</p>
                                                <p class="text-xs text-gray-500">Your order will be shipped soon</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div
                                                class="flex-shrink-0 w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mt-0.5">
                                                <span class="text-xs font-bold text-green-600">3</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Delivery</p>
                                                <p class="text-xs text-gray-500">Receive your products</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                <a href="{{ route('my.orders.invoice.download', $transaction) }}" target="_blank"
                                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                        </path>
                                    </svg>
                                    Download / Print Invoice
                                </a>

                                <a href="{{ route('my.orders.index') }}"
                                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    View All Orders
                                </a>

                                <a href="{{ route('product.index') }}"
                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-xl transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Continue Shopping
                                </a>
                            </div>

                            <!-- Contact Support -->
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center">
                                <div class="mb-4">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-semibold text-gray-900 mb-2">Need Help?</h4>
                                <p class="text-xs text-gray-600 mb-4">
                                    If you have any questions about your order, feel free to contact us.
                                </p>
                                <a href="#"
                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    Contact Support
                                </a>
                            </div>
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
                                    d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Payment Found</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            We couldn't find any successful payment. Please try again or contact support if you believe
                            this is an error.
                        </p>
                        <a href="{{ route('product.index') }}"
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

    <!-- Celebration Effect -->
    <div id="confetti-container" class="fixed inset-0 pointer-events-none z-50"></div>

    <style>
        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            animation: confetti-fall 3s linear infinite;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    <script>
        // Confetti celebration effect
        function createConfetti() {
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
            const confettiContainer = document.getElementById('confetti-container');

            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 3 + 's';
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                confettiContainer.appendChild(confetti);

                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }

        // Start confetti when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(createConfetti, 500);
        });
    </script>
</x-app-layout>
