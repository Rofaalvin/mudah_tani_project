<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mudah Tani - Sistem POS Modern untuk Pertanian</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        'green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Mudah Tani</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-green-600 transition-colors">Fitur</a>
                    <a href="#pricing" class="text-gray-600 hover:text-green-600 transition-colors">Harga</a>
                    <a href="#contact" class="text-gray-600 hover:text-green-600 transition-colors">Kontak</a>
                    @if (Route::has('login'))
                        @auth
                            <button
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                <a href="{{ url('/dashboard') }}">
                                    Dashboard
                                </a>
                            </button>
                        @else
                            <button
                                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                <a href="{{ route('login') }}">
                                    Log In
                                </a>
                            </button>
                            @if (Route::has('register'))
                                <button
                                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    <a href="{{ route('register') }}">
                                        Register
                                    </a>
                                </button>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-green-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Sistem POS
                        <span class="text-green-600">Modern</span>
                        untuk Bisnis Pertanian
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Kelola toko pertanian Anda dengan mudah. Inventory management, penjualan, dan laporan keuangan
                        dalam satu platform yang terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button
                            class="bg-green-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-green-700 transition-all shadow-lg hover:shadow-xl">
                            Mulai Gratis Sekarang
                        </button>
                        <button
                            class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:border-green-600 hover:text-green-600 transition-all">
                            Lihat Demo
                        </button>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Pupuk NPK 25kg</p>
                                        <p class="text-sm text-gray-500">Stok: 50 karung</p>
                                    </div>
                                </div>
                                <p class="font-bold text-green-600">Rp 150.000</p>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Bibit Padi Unggul</p>
                                        <p class="text-sm text-gray-500">Stok: 200 bks</p>
                                    </div>
                                </div>
                                <p class="font-bold text-blue-600">Rp 25.000</p>
                            </div>
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Penjualan Hari Ini</span>
                                    <span class="text-2xl font-bold text-gray-900">Rp 2.850.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Lengkap untuk Bisnis Pertanian
                </h2>
                <p class="text-xl text-gray-600">
                    Semua yang Anda butuhkan untuk mengelola toko pertanian modern
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen Inventory</h3>
                    <p class="text-gray-600">Kelola stok pupuk, pestisida, bibit, dan alat pertanian dengan sistem
                        tracking otomatis dan notifikasi stok menipis.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Kasir & Pembayaran</h3>
                    <p class="text-gray-600">Sistem kasir yang cepat dengan dukungan pembayaran tunai, transfer, dan
                        kredit untuk petani dengan sistem pencatatan lengkap.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Laporan & Analisis</h3>
                    <p class="text-gray-600">Dashboard analitik lengkap dengan laporan penjualan, profit margin, dan
                        tren produk pertanian yang laku keras.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen Customer</h3>
                    <p class="text-gray-600">Database petani dan pelanggan dengan histori pembelian, program loyalitas,
                        dan sistem kredit terintegrasi.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Multi-Device Access</h3>
                    <p class="text-gray-600">Akses dari komputer, tablet, atau smartphone. Data tersinkronisasi
                        real-time di semua perangkat Anda.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Keamanan Data</h3>
                    <p class="text-gray-600">Backup otomatis, enkripsi data, dan kontrol akses pengguna untuk menjaga
                        keamanan informasi bisnis Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-green-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Modernisasi Toko Pertanian Anda?
            </h2>
            <p class="text-xl text-green-100 mb-8">
                Bergabung dengan ribuan toko pertanian yang sudah merasakan kemudahan Mudah Tani
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-50 transition-all shadow-lg">
                    Coba Gratis 30 Hari
                </button>
                <button
                    class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-600 transition-all">
                    Hubungi Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">Mudah Tani</span>
                    </div>
                    <p class="text-gray-400">
                        Solusi POS modern untuk bisnis pertanian Indonesia
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Produk</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Demo</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Dukungan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tutorial</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@mudahtani.com</li>
                        <li>Telepon: (021) 1234-5678</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Mudah Tani. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-sm');
            } else {
                nav.classList.remove('shadow-sm');
            }
        });
    </script>
</body>

</html>
