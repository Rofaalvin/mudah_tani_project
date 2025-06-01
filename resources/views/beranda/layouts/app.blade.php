<!DOCTYPE html>
<html lang="id">
<head>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pembeli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #222;
        }
        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: row;
        }
        .content {
            flex: 1;
            padding: 40px 24px 24px 24px;
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
            .content {
                padding: 16px 4vw;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        {{-- Sidebar --}}
        @include('beranda.layouts.navbar')

        {{-- Konten Utama --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
