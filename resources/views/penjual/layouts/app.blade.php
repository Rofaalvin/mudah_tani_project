<!DOCTYPE html>
<html lang="id">
<head>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel penjual</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .main-container {
            display: flex;
            min-height: 100vh;
        }
        .content {
            flex: 1;
            padding: 30px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="main-container">
        {{-- Sidebar --}}
        @include('penjual.layouts.sidebar')

        {{-- Konten Utama --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
