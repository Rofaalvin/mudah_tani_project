<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mudah Tani</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .search-bar {
            flex-grow: 1;
            margin: 0 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .products {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px;
            padding: 20px;
            width: 200px;
            text-align: center;
        }

        .product img {
            max-width: 100%;
            height: auto;
        }

        .price {
            font-size: 20px;
            margin: 10px 0;
        }

        .cart-icon {
            font-size: 25px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Mudah Tani</h1>
        <div class="search-bar">
            <input type="text" placeholder="search...">
        </div>
        <div class="user-icon">
            <span class="cart-icon">🛒</span>
        </div>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </li>
    </header>

    <div class="products">
        @forelse ($produks as $produk)
            <div class="product">
                <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                <h2>{{ $produk->nama_produk }}</h2>
                <div class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                {{-- Debug --}}
                {{-- {{ dd($produk->id_produk) }} --}}

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
        <p style="text-align: center; padding: 20px; background-color: #fff; margin-top: 20px;">&copy; 2023 Mudah Tani
        </p>
    </footer>
</body>

</html>
