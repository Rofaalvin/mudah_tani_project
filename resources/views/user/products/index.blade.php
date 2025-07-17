<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                {{ __('Products') }}
            </h2>
            <div class="flex items-center space-x-2 text-sm text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span class="font-medium">{{ $produks->count() }} Products</span>
            </div>
        </div>
    </x-slot>

    <!-- Cart Notification -->
    <div id="cartNotification"
        class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Product added to cart!</span>
        </div>
    </div>

    <!-- Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Search Bar -->
        <div class="mb-8">
            {{-- Arahkan form ke route yang menampilkan halaman ini dengan method GET --}}
            <form action="{{ route('product.index') }}" method="GET">
                <div class="relative">
                    <input type="search" name="search" id="searchInput"
                        class="w-full border-gray-300 rounded-lg pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Search for products by name..." {{-- Tampilkan kembali kata kunci pencarian --}} value="{{ $search ?? '' }}">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($produks as $produk)
                <div
                    class="product-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-gray-100 h-64">
                        @if ($produk->gambar)
                            <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <!-- Quick View Button -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <button
                                class="bg-white text-gray-900 px-4 py-2 rounded-full font-medium opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                Quick View
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                            {{ $produk->nama_produk }}
                        </h3>

                        @if ($produk->deskripsi)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $produk->deskripsi }}
                            </p>
                        @endif

                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                                @if (isset($produk->harga_asli) && $produk->harga_asli > $produk->harga)
                                    <span class="text-sm text-gray-500 line-through ml-2">
                                        Rp {{ number_format($produk->harga_asli, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                            @if (isset($produk->stok))
                                <span
                                    class="text-xs px-2 py-1 rounded-full {{ $produk->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $produk->stok > 0 ? 'In Stock' : 'Out of Stock' }} - {{ $produk->stok }} pcs
                                </span>
                            @endif
                        </div>

                        <!-- Add to Cart Button -->
                        <form action="{{ route('cart.add', $produk->id_produk) }}" method="POST"
                            class="add-to-cart-form">
                            @csrf
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2"
                                {{ isset($produk->stok) && $produk->stok <= 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4.01">
                                    </path>
                                </svg>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-4.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7">
                            </path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Found</h3>
                        <p class="text-gray-600">We don't have any products available at the moment. Please check back
                            later!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Load More Button -->
        @if ($produks->count() > 0)
            <div class="text-center mt-12">
                <button id="loadMoreBtn"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-8 rounded-xl transition-colors duration-200">
                    Load More Products
                </button>
            </div>
        @endif
    </div>

    <!-- Shopping Cart Sidebar -->
    <div id="cartSidebar"
        class="fixed inset-y-0 right-0 w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 overflow-hidden">
        <div class="flex flex-col h-full">
            <!-- Cart Header -->
            <div
                class="flex items-center justify-between p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4.01">
                        </path>
                    </svg>
                    Shopping Cart
                    <span id="cartItemCount"
                        class="ml-2 bg-blue-600 text-white text-sm px-2 py-1 rounded-full">{{ $cartCount }}</span>
                </h3>
                <button id="closeCartBtn" class="text-gray-500 hover:text-gray-700 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Cart Items -->
            <div id="cartItems" class="flex-1 overflow-y-auto p-6">
                <!-- Cart items will be loaded here via AJAX -->
            </div>

            <!-- Cart Footer -->
            <div class="border-t border-gray-200 p-6 bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold text-gray-900">Total:</span>
                    <span id="cartTotal" class="text-2xl font-bold text-blue-600">Rp 0</span>
                </div>
                <a href="{{ route('checkout.index') }}"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 text-center block">
                    Proceed to Checkout
                </a>
            </div>
        </div>
    </div>

    <!-- Cart Overlay -->
    <div id="cartOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 z-40"></div>

    <!-- Floating Cart Button -->
    <div class="fixed bottom-6 right-6 z-30">
        <button id="cartToggleBtn"
            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-4 rounded-full shadow-2xl transition-all duration-200 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-blue-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4.01">
                </path>
            </svg>
            <span id="floatingCartCount"
                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center {{ $cartCount > 0 ? '' : 'hidden' }}">{{ $cartCount }}</span>
        </button>
    </div>

    @push('styles')
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-card {
                border: 1px solid transparent;
            }

            .product-card:hover {
                border-color: #e5e7eb;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Cart functionality
                let cartCount = {{ $cartCount }};

                // Add to cart forms
                document.querySelectorAll('.add-to-cart-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const button = form.querySelector('button[type="submit"]');
                        const originalText = button.innerHTML;

                        // Show loading state
                        button.innerHTML =
                            '<svg class="animate-spin w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>';
                        button.disabled = true;

                        fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Update cart count
                                cartCount++;
                                updateCartCount();

                                // Show notification
                                showNotification('Product added to cart!');

                                // Reset button
                                button.innerHTML = originalText;
                                button.disabled = false;

                                // Load cart items
                                loadCartItems();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                button.innerHTML = originalText;
                                button.disabled = false;
                                showNotification('Error adding product to cart!', 'error');
                            });
                    });
                });

                // Cart sidebar functionality
                const cartSidebar = document.getElementById('cartSidebar');
                const cartOverlay = document.getElementById('cartOverlay');
                const cartToggleBtn = document.getElementById('cartToggleBtn');
                const closeCartBtn = document.getElementById('closeCartBtn');

                function openCart() {
                    cartSidebar.classList.remove('translate-x-full');
                    cartOverlay.classList.remove('opacity-0', 'invisible');
                    document.body.style.overflow = 'hidden';
                    loadCartItems();
                }

                function closeCart() {
                    cartSidebar.classList.add('translate-x-full');
                    cartOverlay.classList.add('opacity-0', 'invisible');
                    document.body.style.overflow = '';
                }

                cartToggleBtn.addEventListener('click', openCart);
                closeCartBtn.addEventListener('click', closeCart);
                cartOverlay.addEventListener('click', closeCart);

                // Load cart items
                function loadCartItems() {
                    fetch('{{ route('cart.list') }}')
                        .then(response => response.json())
                        .then(cart => {
                            const cartItemsContainer = document.getElementById('cartItems');
                            const cartTotal = document.getElementById('cartTotal');

                            if (Object.keys(cart).length === 0) {
                                cartItemsContainer.innerHTML = `
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4.01"></path>
                                </svg>
                                <p class="text-gray-500">Your cart is empty</p>
                            </div>
                        `;
                                cartTotal.textContent = 'Rp 0';
                                return;
                            }

                            let total = 0;
                            let itemsHtml = '';

                            Object.keys(cart).forEach(id => {
                                const item = cart[id];
                                const subtotal = item.harga * item.quantity;
                                total += subtotal;

                                itemsHtml += `
                            <div class="flex items-center space-x-4 mb-4 p-4 bg-gray-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    ${item.gambar ? 
                                        `<img src="/${item.gambar}" alt="${item.nama_produk}" class="w-16 h-16 object-cover rounded-lg">` :
                                        `<div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>`
                                    }
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">${item.nama_produk}</h4>
                                    <p class="text-sm text-gray-500">Rp ${number_format(item.harga)}</p>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <button onclick="updateQuantity('${id}', ${item.quantity - 1})" class="w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-medium">-</button>
                                        <span class="text-sm font-medium">${item.quantity}</span>
                                        <button onclick="updateQuantity('${id}', ${item.quantity + 1})" class="w-8 h-8 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-medium">+</button>
                                    </div>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    Rp ${number_format(subtotal)}
                                </div>
                            </div>
                        `;
                            });

                            cartItemsContainer.innerHTML = itemsHtml;
                            cartTotal.textContent = `Rp ${number_format(total)}`;
                        });
                }

                // Update quantity function
                window.updateQuantity = function(id, quantity) {
                    if (quantity <= 0) {
                        // Remove item logic here
                        return;
                    }

                    fetch('{{ route('cart.update') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                id: id,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                cartCount = data.cartCount;
                                updateCartCount();
                                loadCartItems();
                            }
                        });
                };

                // Update cart count display
                function updateCartCount() {
                    document.getElementById('cartItemCount').textContent = cartCount;
                    const floatingCount = document.getElementById('floatingCartCount');
                    floatingCount.textContent = cartCount;

                    if (cartCount > 0) {
                        floatingCount.classList.remove('hidden');
                    } else {
                        floatingCount.classList.add('hidden');
                    }
                }

                // Show notification
                function showNotification(message, type = 'success') {
                    const notification = document.getElementById('cartNotification');
                    notification.textContent = message;

                    if (type === 'error') {
                        notification.classList.remove('bg-green-500');
                        notification.classList.add('bg-red-500');
                    } else {
                        notification.classList.remove('bg-red-500');
                        notification.classList.add('bg-green-500');
                    }

                    notification.classList.remove('translate-x-full');

                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                    }, 3000);
                }

                // Number formatting function
                function number_format(number) {
                    return new Intl.NumberFormat('id-ID').format(number);
                }

                // Search functionality
                const searchInput = document.getElementById('searchInput');
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const productCards = document.querySelectorAll('.product-card');

                    productCards.forEach(card => {
                        const productName = card.querySelector('h3').textContent.toLowerCase();
                        if (productName.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });

                // Filter functionality
                const categoryFilter = document.getElementById('categoryFilter');
                const sortFilter = document.getElementById('sortFilter');

                // Add filter and sort functionality here as needed
            });
        </script>
    @endpush

</x-app-layout>
