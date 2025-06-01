<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudah Tani</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #222;
        }

        header {
            background: #fff;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 10;
            position: relative;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            color: #2d6a4f;
            letter-spacing: 1px;
        }

        .search-bar {
            flex-grow: 1;
            margin: 0 32px;
            max-width: 400px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid #b7b7b7;
            border-radius: 24px;
            font-size: 16px;
            background: #f1f5f9;
            transition: border 0.2s;
        }

        .search-bar input:focus {
            border: 1.5px solid #2d6a4f;
            outline: none;
            background: #fff;
        }

        .user-icon {
            display: flex;
            align-items: center;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 12px;
            flex-shrink: 0;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-details h6 {
            margin: 0;
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }

        .cart-item-details small {
            color: #6c757d;
            font-size: 13px;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            border-top: 1px solid #f0f0f0;
            background: #f8f9fa;
        }

        .cart-actions a {
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .cart-actions .view-cart {
            background: #fff;
            color: #2d6a4f;
            border: 1px solid #2d6a4f;
        }

        .cart-actions .view-cart:hover {
            background: #2d6a4f;
            color: #fff;
        }

        .cart-actions .checkout {
            background: #2d6a4f;
            color: #fff;
        }

        .cart-actions .checkout:hover {
            background: #40916c;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            margin-top: 4px;
        }

        .quantity-btn {
            width: 24px;
            height: 24px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            user-select: none;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity-value {
            margin: 0 10px;
            min-width: 20px;
            text-align: center;
        }

        .cart-item-actions {
            display: flex;
            margin-top: 8px;
        }

        .update-btn {
            background: #2d6a4f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 12px;
            margin-left: 8px;
            cursor: pointer;
        }

        .update-btn:hover {
            background: #40916c;
        }


        .logout-link {
            list-style: none;
            margin: 0 0 0 24px;
            padding: 0;
        }

        .logout-link a {
            text-decoration: none;
            color: #40916c;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 20px;
            transition: background 0.2s, color 0.2s;
        }

        .logout-link a:hover {
            background: #2d6a4f;
            color: #fff;
        }

        .products {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 32px;
            padding: 40px 0 60px 0;
        }

        .product {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(44, 62, 80, 0.08);
            margin: 0;
            padding: 28px 20px 24px 20px;
            width: 240px;
            text-align: center;
            transition: transform 0.18s, box-shadow 0.18s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 12px 32px rgba(44, 62, 80, 0.13);
        }

        .product img {
            max-width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
        }

        .product h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 10px 0;
            color: #22223b;
        }

        .price {
            font-size: 18px;
            font-weight: 500;
            color: #2d6a4f;
            margin-bottom: 18px;
        }

        .product form button {
            background: linear-gradient(90deg, #2d6a4f 0%, #40916c 100%);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 28px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .product form button:hover {
            background: linear-gradient(90deg, #40916c 0%, #2d6a4f 100%);
            transform: scale(1.04);
        }

        footer {
            text-align: center;
            padding: 28px 0 18px 0;
            background: #fff;
            margin-top: 40px;
            font-size: 15px;
            color: #7c7c7c;
            box-shadow: 0 -2px 12px rgba(44, 62, 80, 0.04);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #e63946;
            color: #fff;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .cart-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            width: 320px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            display: none;
            z-index: 1000;
        }

        .cart-dropdown.show {
            display: block;
        }

        .cart-header {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f0f0;
            font-weight: 600;
            color: #333;
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
        }

        .cart-icon-container {
            position: relative;
            cursor: pointer;
            padding: 8px;
            margin-left: 16px;
        }

        .cart-icon {
            font-size: 20px;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        @media (max-width: 700px) {
            .products {
                gap: 18px;
                padding: 20px 0 40px 0;
            }

            .product {
                width: 90vw;
                max-width: 340px;
                padding: 18px 8px 18px 8px;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
                padding: 14px 10px;
            }

            .search-bar {
                margin: 12px 0;
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Mudah Tani</h1>
        <div class="search-bar">
            <input type="text" placeholder="Cari produk...">
        </div>
        <div class="header-right">
            <div class="cart-icon-container" id="cartBtn">
                <span class="cart-icon">🛒</span>
                @if (isset($cartCount) && $cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </div>
            <ul class="logout-link">
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Cart Dropdown -->
        <div class="cart-dropdown" id="cartDropdown">
            <div class="cart-header">Keranjang Belanja</div>
            <div class="cart-items" id="cart-list-content">
                <div class="text-center text-muted p-3">Keranjang kosong.</div>
            </div>
        </div>
    </header>

    <div class="products">
        @forelse ($produks as $produk)
            <div class="product">
                <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                <h2>{{ $produk->nama_produk }}</h2>
                <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                <div style="margin-bottom: 14px; color: #6c757d; font-size: 15px;">
                    Stok: <span style="font-weight:600;">{{ $produk->stok }}</span>
                </div>
                <form action="{{ route('cart.add', ['id' => $produk->id_produk]) }}" method="POST">
                    @csrf
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        @empty
            <p>Tidak ada produk tersedia.</p>
        @endforelse
    </div>

    <footer>
        <p>&copy; 2023 Mudah Tani</p>
    </footer>

    <script>
        // Tambahkan script untuk toggle cart dropdown
        document.getElementById('cartBtn').addEventListener('click', function() {
            document.getElementById('cartDropdown').classList.toggle('show');
        });

        // Tutup dropdown ketika klik di luar
        window.addEventListener('click', function(e) {
            if (!e.target.closest('#cartBtn') && !e.target.closest('#cartDropdown')) {
                document.getElementById('cartDropdown').classList.remove('show');
            }
        });

        // Fetch cart data (sama seperti sebelumnya)
        fetch("{{ route('cart.list') }}")
            .then(res => res.json())
            .then(cart => {
                let html = '';
                if (Object.keys(cart).length === 0) {
                    html = '<div class="text-center text-muted p-3">Keranjang kosong.</div>';
                } else {
                    html = '';
                    let total = 0;
                    Object.values(cart).forEach(item => {
                        // Hitung subtotal
                        item.subtotal = item.quantity * item.harga;

                        html += `
                            <div class="cart-item">
                                <img src="/${item.gambar}" alt="${item.nama_produk}">
                                <div class="cart-item-details">
                                    <h6>${item.nama_produk}</h6>
                                    <small>
                                        x${item.quantity} &middot; 
                                        Rp ${parseInt(item.harga).toLocaleString('id-ID')} &middot; 
                                        Subtotal: Rp ${item.subtotal.toLocaleString('id-ID')}
                                    </small>
                                </div>
                            </div>
                        `;
                        total += item.subtotal;
                    });

                    html += `
                    <div class="cart-total" style="padding: 12px; border-top: 1px solid #f0f0f0; font-weight: 600;">
                        Total: Rp ${total.toLocaleString('id-ID')}
                    </div>
                    <div class="cart-actions">
                        <a href="{{ route('checkout.index') }}" class="checkout">Checkout</a>
                    </div>
                `;
                }
                document.getElementById('cart-list-content').innerHTML = html;
            });
    </script>
</body>

</html>
