@extends('penjual.layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Data Pembelian</h2>

    <div class="btn-container">
        <a href="{{ url('/pembelian') }}" class="btn-green">Input Pembelian</a>
        <a href="{{ url('/data_beli') }}" class="btn-green">Lihat Data Pembelian</a>
    </div>

    {{-- Wadah untuk dua grafik --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
        {{-- Grafik 1: Pembelian Harian --}}
        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">
                Grafik Total Pembelian Harian (6 Bulan Terakhir)
            </h3>
            <div class="relative h-72"> {{-- h-72 adalah class Tailwind untuk height: 18rem / 288px --}}
                <canvas id="grafikPembelian"></canvas> {{-- Hapus style dari canvas --}}
            </div>
        </div>

        {{-- Grafik 2: Produk Terlaris --}}
        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">
                5 Produk Terlaris ({{ now()->format('F Y') }})
            </h3>
            <div class="relative h-72">
                <canvas id="grafikProdukTerlaris"></canvas> {{-- Hapus style dari canvas --}}
            </div>
        </div>
    </div>

    {{-- Filter Bulan --}}
    <div class="bg-white p-4 rounded-lg shadow-md mb-5">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <form action="{{ route('data_beli.index') }}" method="GET" class="flex items-center space-x-2">
                <label for="filter_bulan" class="text-sm font-medium text-gray-700">Filter Bulan:</label>
                <input type="month" id="filter_bulan" name="filter_bulan"
                    value="{{ $filterBulan ?? now()->format('Y-m') }}"
                    class="border border-gray-300 rounded-md px-2 py-1 text-sm">
                <button type="submit"
                    class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700">Filter</button>
            </form>
        </div>
    </div>

    <!-- Form Pencarian -->
    <div class="mb-4">
        <form action="{{ route('data_beli.index') }}" method="GET" class="flex items-center">
            <input type="hidden" name="filter_bulan" value="{{ $filterBulan ?? now()->format('Y-m') }}">
            <input type="search" name="search"
                class="border border-gray-300 rounded-l px-2 py-1 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Cari kode, nama barang, atau supplier..." value="{{ $search ?? '' }}">
            <button type="submit" class="bg-gray-700 text-white px-4 py-1 rounded-r hover:bg-gray-800">Cari</button>
            <a href="{{ route('data_beli.index') }}" class="text-sm text-gray-600 hover:text-gray-900 ml-4">Reset</a>
        </form>
    </div>

    {{-- Tabel Data Pembelian --}}
    @if (isset($pembelianItems) && $pembelianItems->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="table w-full border border-gray-400 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Kode Transaksi</th>
                        <th class="border px-2 py-1">Nama Supplier</th>
                        <th class="border px-2 py-1">Tanggal</th>
                        <th class="border px-2 py-1">Nama Barang</th>
                        <th class="border px-2 py-1">Qty</th>
                        <th class="border px-2 py-1">Harga Satuan</th>
                        <th class="border px-2 py-1">Subtotal Item</th>
                        <th class="border px-2 py-1">Diskon</th>
                        <th class="border px-2 py-1">Total Final</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelianItems as $kode_trx => $items)
                        @php
                            $firstItem = $items->first();
                            $rowspan = count($items);
                        @endphp
                        @foreach ($items as $item)
                            <tr>
                                @if ($loop->first)
                                    <td class="border px-2 py-1 text-center align-middle" rowspan="{{ $rowspan }}">
                                        {{ $kode_trx }}
                                    </td>
                                    <td class="border px-2 py-1 text-center align-middle" rowspan="{{ $rowspan }}">
                                        {{ $firstItem->supplyer->nama_supplyer ?? '-' }}
                                    </td>
                                    <td class="border px-2 py-1 text-center align-middle" rowspan="{{ $rowspan }}">
                                        {{ \Carbon\Carbon::parse($firstItem->tanggal)->format('d M Y') }}
                                    </td>
                                @endif

                                <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
                                <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->total, 0, ',', '.') }}
                                </td>

                                @if ($loop->first)
                                    <td class="border px-2 py-1 text-center align-middle font-semibold"
                                        rowspan="{{ $rowspan }}">
                                        {{ $firstItem->diskon }}%
                                    </td>
                                    <td class="border px-2 py-1 text-right align-middle font-semibold"
                                        rowspan="{{ $rowspan }}">
                                        Rp {{ number_format($firstItem->total_final, 0, ',', '.') }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600 text-center">
                @if (!empty($search))
                    Tidak ada data pembelian yang cocok dengan kata kunci "{{ $search }}".
                @else
                    Belum ada data pembelian untuk bulan
                    {{ \Carbon\Carbon::parse($filterBulan ?? now()->format('Y-m'))->format('F Y') }}.
                @endif
            </p>
        </div>
    @endif

    {{-- Script untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === SCRIPT UNTUK GRAFIK 1: PEMBELIAN HARIAN ===
            const ctxPembelian = document.getElementById('grafikPembelian').getContext('2d');
            const labelsPembelian = @json($chartLabels ?? []);
            const dataPembelian = @json($chartData ?? []);

            if (labelsPembelian.length === 0) {
                const canvas = ctxPembelian.canvas;
                ctxPembelian.font = '16px Arial';
                ctxPembelian.fillStyle = '#666';
                ctxPembelian.textAlign = 'center';
                ctxPembelian.fillText('Tidak ada data untuk ditampilkan', canvas.width / 2, canvas.height / 2);
            } else {
                new Chart(ctxPembelian, {
                    type: 'line',
                    data: {
                        labels: labelsPembelian,
                        datasets: [{
                            label: 'Total Pembelian',
                            data: dataPembelian,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: true
                        }]
                    },
                    options: {
                        /* ... (Opsi tidak berubah) ... */
                    }
                });
            }

            // === (BARU) SCRIPT UNTUK GRAFIK 2: PRODUK TERLARIS ===
            const ctxProduk = document.getElementById('grafikProdukTerlaris').getContext('2d');
            const labelsProduk = @json($produkLabels ?? []);
            const dataProduk = @json($produkData ?? []);

            if (labelsProduk.length === 0) {
                const canvas = ctxProduk.canvas;
                ctxProduk.font = '16px Arial';
                ctxProduk.fillStyle = '#666';
                ctxProduk.textAlign = 'center';
                ctxProduk.fillText('Tidak ada produk terbeli bulan ini', canvas.width / 2, canvas.height / 2);
            } else {
                new Chart(ctxProduk, {
                    type: 'bar', // Menggunakan tipe 'bar' untuk perbandingan
                    data: {
                        labels: labelsProduk,
                        datasets: [{
                            label: 'Jumlah Terbeli',
                            data: dataProduk,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah (Qty)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Sembunyikan legenda karena sudah jelas dari label
                            }
                        }
                    }
                });
            }
        });
    </script>

    <style>
        .btn-green {
            background-color: #16a34a;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 0.125rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .btn-green:hover {
            background-color: #15803d;
        }

        .btn-container {
            margin-bottom: 0.75rem;
            display: flex;
            gap: 0.75rem;
        }
    </style>
@endsection
