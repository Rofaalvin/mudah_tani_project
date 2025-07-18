<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Checkout') }}
            </h2>
            <div class="hidden sm:flex items-center space-x-2 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span>Secure Checkout</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 lg:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $cart = session('cart', []);
                $total = 0;
            @endphp

            @if (count($cart) > 0)
                <form id="checkout-form" action="{{ route('order.proses') }}">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Cart Items Section -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                                <div
                                    class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 1.5M7 13l1.5-1.5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z">
                                            </path>
                                        </svg>
                                        Items in Cart ({{ count($cart) }})
                                    </h3>
                                </div>

                                <div class="divide-y divide-gray-100">
                                    @foreach ($cart as $item)
                                        @php
                                            $subtotal = $item['harga'] * $item['quantity'];
                                            $total += $subtotal;
                                        @endphp
                                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset($item['gambar']) }}"
                                                        alt="{{ $item['nama_produk'] }}"
                                                        class="w-20 h-20 object-cover rounded-xl shadow-md border-2 border-white">
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <h4 class="text-lg font-semibold text-gray-900 mb-1">
                                                        {{ $item['nama_produk'] }}
                                                    </h4>

                                                    <div
                                                        class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                        <div class="flex items-center">
                                                            <span class="font-medium">Price:</span>
                                                            <span class="ml-1 text-blue-600 font-semibold">
                                                                Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <span class="font-medium">Qty:</span>
                                                            <span
                                                                class="ml-1 bg-gray-100 px-2 py-1 rounded-md font-semibold">
                                                                {{ $item['quantity'] }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <span class="text-lg font-bold text-gray-900">
                                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Section -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 sticky top-4">
                                <div
                                    class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-100 rounded-t-2xl">
                                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Order Summary
                                    </h3>
                                </div>

                                <div class="p-6 space-y-4" id="order-summary" data-subtotal="{{ $total }}">
                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Subtotal ({{ count($cart) }} items)</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-900">Shipping Method</label>
                                        <div class="mt-2 space-y-2">
                                            <div class="flex items-center">
                                                <input id="pickup" name="delivery_method" type="radio"
                                                    value="pickup"
                                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                                    checked>
                                                <label for="pickup" class="ml-3 block text-sm text-gray-700">
                                                    Picked up at the store
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="delivery" name="delivery_method" type="radio"
                                                    value="delivery"
                                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                <label for="delivery" class="ml-3 block text-sm text-gray-700">
                                                    Delivery (Additional Charge)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="shipping-address-container" class="hidden">
                                        <label for="shipping_address" class="text-sm font-medium text-gray-900">Shipping
                                            Address</label>
                                        <textarea id="shipping_address" name="shipping_address" rows="3"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Enter your full address, including street name, house number, and zip code."></textarea>
                                        @error('shipping_address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex justify-between items-center text-sm text-gray-600">
                                        <span>Shipping Cost</span>
                                        <span id="shipping-cost-display" class="font-medium">Rp 0</span>
                                    </div>

                                    <hr class="border-gray-200">

                                    <div class="flex justify-between items-center text-lg font-bold text-gray-900">
                                        <span>Total</span>
                                        <span id="total-amount-display" class="text-2xl text-green-600">
                                            Rp {{ number_format($total, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center group">
                                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Process Order
                                        </button>
                                    </div>

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
                                                <span>Money Back Guarantee</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <!-- Empty Cart State -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="text-center py-16 px-6">
                        <div class="mb-6">
                            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 1.5M7 13l1.5-1.5"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Looks like you haven't added any items to your cart yet. Start shopping to fill it up!
                        </p>
                        <a href="{{ route('product.index') }}"
                            class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deliveryRadios = document.querySelectorAll('input[name="delivery_method"]');
                const summaryContainer = document.getElementById('order-summary');
                const shippingCostDisplay = document.getElementById('shipping-cost-display');
                const totalAmountDisplay = document.getElementById('total-amount-display');
                const addressContainer = document.getElementById('shipping-address-container');
                const addressTextarea = document.getElementById('shipping_address');

                // Pastikan summaryContainer ditemukan sebelum melanjutkan
                if (!summaryContainer) {
                    console.error('Order summary container not found!');
                    return;
                }

                const lastUsedAddress = @json($lastShippingAddress ?? null);

                const shippingFee = 12000;
                // Ambil subtotal dari data attribute
                const subtotal = parseFloat(summaryContainer.dataset.subtotal);

                // Fungsi untuk format angka ke Rupiah
                function formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number).replace(/\s*IDR/g, 'Rp ');
                }

                // Fungsi untuk update total
                function updateTotal() {
                    const selectedMethod = document.querySelector('input[name="delivery_method"]:checked').value;
                    let currentShippingCost = 0;

                    if (selectedMethod === 'delivery') {
                        currentShippingCost = shippingFee;
                        addressContainer.classList.remove('hidden');
                        if (lastUsedAddress) {
                            addressTextarea.value = lastUsedAddress;
                        }
                    } else {
                        addressContainer.classList.add('hidden');
                        addressTextarea.value = '';
                    }

                    const finalTotal = subtotal + currentShippingCost;

                    // Update tampilan biaya pengiriman dan total
                    shippingCostDisplay.textContent = formatRupiah(currentShippingCost);
                    totalAmountDisplay.textContent = formatRupiah(finalTotal);
                }

                // Tambahkan event listener untuk setiap radio button
                deliveryRadios.forEach(radio => {
                    radio.addEventListener('change', updateTotal);
                });

                // Panggil sekali saat halaman dimuat untuk memastikan tampilan awal benar
                updateTotal();
            });
        </script>
    @endpush
</x-app-layout>
