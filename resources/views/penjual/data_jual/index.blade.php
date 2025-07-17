@extends('penjual.layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Data Penjualan</h2>

    <div class="btn-container">
        <a href="{{ url('/penjualan') }}" class="btn-green">Input Penjualan</a>
        <a href="{{ url('/data_jual') }}" class="btn-green">Lihat Data Penjualan</a>
    </div>

    <!-- GRAFIK PENJUALAN 6 BULAN TERAKHIR -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Grafik Penjualan 6 Bulan Terakhir</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="grafikPenjualanBulanan"></canvas>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-2 text-gray-700">5 Produk Terlaris ({{ now()->format('F Y') }})</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="grafikProdukTerlaris"></canvas>
            </div>
        </div>
    </div>

    <div class="mb-4 border-b border-gray-200">
        <nav class="flex -mb-px space-x-6" aria-label="Tabs">
            <a href="{{ route('data_jual.index', array_merge(request()->except('page', 'sumber'), ['sumber' => 'semua'])) }}"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $sumber === 'semua' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Semua Penjualan
            </a>
            <a href="{{ route('data_jual.index', array_merge(request()->except('page', 'sumber'), ['sumber' => 'kasir'])) }}"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $sumber === 'kasir' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Penjualan Kasir
            </a>
            <a href="{{ route('data_jual.index', array_merge(request()->except('page', 'sumber'), ['sumber' => 'website'])) }}"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm {{ $sumber === 'website' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Penjualan Website
            </a>
        </nav>
    </div>

    <div class="mb-4">
        <form action="{{ route('data_jual.index') }}" method="GET" class="flex items-center">
            <input type="hidden" name="sumber" value="{{ $sumber }}">

            <input type="search" name="search"
                class="border border-gray-300 rounded-l px-2 py-1 w-full md:w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Cari kode transaksi, pembeli, produk..." value="{{ $search ?? '' }}">
            <button type="submit" class="bg-gray-700 text-white px-4 py-1 rounded-r hover:bg-gray-800">Cari</button>
            <a href="{{ route('data_jual.index', ['sumber' => $sumber]) }}"
                class="text-sm text-gray-600 hover:text-gray-900 ml-4">Reset</a>
        </form>
    </div>

    {{-- Sisa konten Anda (tabel, dll.) tetap sama --}}
    @if (count($penjualans) > 0)
        @forelse($penjualans as $penjualan)
            {{-- ... Konten forelse Anda di sini ... --}}
            <div class="mb-6 border border-gray-300 rounded-lg overflow-hidden shadow-sm bg-white">
                <div class="px-4 py-2 bg-gray-100 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <span class="font-semibold">Kode Transaksi:</span> {{ $penjualan->kode_trx_jual }}<br>
                        <span class="font-semibold">Nama Pembeli:</span> {{ $penjualan->user->name ?? '-' }}<br>
                        <span class="font-semibold">Tanggal:</span> {{ $penjualan->tanggal }}<br>
                        <span class="font-semibold">Status:</span> {{ $penjualan->status }}
                        <p><span class="font-semibold w-28 inline-block">Metode</span>:
                            <span
                                class="font-semibold {{ $penjualan->delivery_method == 'delivery' ? 'text-blue-600' : 'text-purple-600' }}">
                                {{ $penjualan->delivery_method == 'pickup' ? 'Diambil di Toko' : 'Diantar' }}
                            </span>
                        </p>
                        {{-- Tampilkan info pengiriman HANYA jika delivery --}}
                        @if ($penjualan->delivery_method == 'delivery')
                            <div class="mt-2 text-sm">
                                <p class="font-semibold">Alamat Pengiriman:</p>
                                <p class="text-gray-700 whitespace-pre-wrap">{{ $penjualan->shipping_address }}</p>

                                <div class="mt-2">
                                    <p class="font-semibold">Status Pengiriman:</p>
                                    @php
                                        $statusClass = '';
                                        switch ($penjualan->shipping_status) {
                                            case 'shipped':
                                                $statusClass = 'bg-blue-100 text-blue-800';
                                                break;
                                            case 'delivered':
                                                $statusClass = 'bg-green-100 text-green-800';
                                                break;
                                            case 'cancelled':
                                                $statusClass = 'bg-red-100 text-red-800';
                                                break;
                                            default:
                                                // processing
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                        }
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusClass }}">
                                        {{ ucfirst($penjualan->shipping_status) }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($penjualan->delivery_method == 'delivery' && !empty($penjualan->shipping_address))
                        <div class="px-4 py-3 border-t border-gray-200">
                            <p class="font-semibold text-sm">Alamat Pengiriman:</p>
                            <p class="text-gray-700 text-sm whitespace-pre-wrap">{{ $penjualan->shipping_address }}</p>
                        </div>
                    @endif
                    <div class="mt-2 md:mt-0 text-sm w-full md:w-auto md:min-w-[280px] bg-white p-3 rounded-md border">
                        <div class="flex justify-between pb-1">
                            <span>Subtotal:</span>
                            <span>Rp {{ number_format($penjualan->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pb-1">
                            <span>Ongkos Kirim:</span>
                            <span>Rp {{ number_format($penjualan->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pb-1 border-b">
                            <span>Diskon:</span>
                            <span class="font-semibold">{{ $penjualan->diskon }}%</span>
                        </div>
                        <div class="flex justify-between font-bold pt-1 text-base">
                            <span>Total Akhir:</span>
                            <span class="text-green-700">Rp
                                {{ number_format($penjualan->total_final, 0, ',', '.') }}</span>
                        </div>
                        {{-- Form Edit Status HANYA jika delivery --}}
                        @if ($penjualan->delivery_method == 'delivery')
                            <form action="{{ route('data_jual.updateStatus', $penjualan) }}" method="POST"
                                class="mt-3 border-t pt-3">
                                @csrf
                                @method('PATCH')
                                <label for="shipping_status-{{ $penjualan->id }}"
                                    class="text-xs font-semibold text-gray-600">Update Status Pengiriman:</label>
                                <div class="flex items-center mt-1">
                                    <select name="shipping_status" id="shipping_status-{{ $penjualan->id }}"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="processing"
                                            {{ $penjualan->shipping_status == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="shipped"
                                            {{ $penjualan->shipping_status == 'shipped' ? 'selected' : '' }}>Shipped
                                        </option>
                                        <option value="delivered"
                                            {{ $penjualan->shipping_status == 'delivered' ? 'selected' : '' }}>Delivered
                                        </option>
                                        <option value="cancelled"
                                            {{ $penjualan->shipping_status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                        </option>
                                    </select>
                                    <button type="submit"
                                        class="ml-2 bg-indigo-600 text-white px-3 py-1 rounded-md text-sm hover:bg-indigo-700">Update</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                @if ($penjualan->items && count($penjualan->items) > 0)
                    <table class="table w-full border-t border-gray-300 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border px-2 py-1">Kode Barang</th>
                                <th class="border px-2 py-1">Nama Barang</th>
                                <th class="border px-2 py-1">Qty</th>
                                <th class="border px-2 py-1">Harga</th>
                                <th class="border px-2 py-1">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->items as $item)
                                <tr>
                                    <td class="border px-2 py-1 text-center">{{ $item->id_produk ?? '-' }}</td>
                                    <td class="border px-2 py-1">{{ $item->nama_produk }}</td>
                                    <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                    <td class="border px-2 py-1 text-right">Rp
                                        {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="border px-2 py-1 text-right">Rp
                                        {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-4 py-2 text-gray-500">Tidak ada item pada penjualan ini.</div>
                @endif
            </div>
        @empty
            <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 p-4 rounded-lg">
                <p class="font-semibold">Tidak Ada Hasil</p>
                @if (!empty($search))
                    <p>Tidak ada data penjualan yang cocok dengan kata kunci "{{ $search }}".</p>
                @else
                    <p>Belum ada data penjualan.</p>
                @endif
            </div>
        @endforelse
        <div class="mt-6">
            {{ $penjualans->links() }}
        </div>
    @else
        <p class="text-gray-600 mt-4">Belum ada data penjualan.</p>
    @endif

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

@push('scripts')
    {{-- Cukup satu CDN yang andal --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('grafikPenjualanBulanan');
            if (!canvas) {
                console.error('Elemen canvas tidak ditemukan!');
                return;
            }
            const ctx = canvas.getContext('2d');

            // Ambil data dari controller
            const labels = @json($chartLabels ?? []);
            const data = @json($chartData ?? []);

            // Cek jika data kosong
            if (labels.length === 0) {
                ctx.font = '16px Arial';
                ctx.fillStyle = '#6B7280';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data penjualan untuk ditampilkan dalam 6 bulan terakhir.', canvas.width / 2,
                    50);
                return;
            }

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Penjualan Bulanan',
                        data: data,
                        backgroundColor: 'rgba(22, 163, 74, 0.5)',
                        borderColor: 'rgba(22, 163, 74, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting agar chart mengisi div
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(context
                                        .parsed.y);
                                }
                            }
                        }
                    }
                }
            });
            const ctxProduk = document.getElementById('grafikProdukTerlaris').getContext('2d');
            const labelsProduk = @json($produkLabels ?? []);
            const dataProduk = @json($produkData ?? []);

            if (labelsProduk.length > 0) {
                new Chart(ctxProduk, {
                    type: 'bar',
                    data: {
                        labels: labelsProduk,
                        datasets: [{
                            label: 'Jumlah Terjual',
                            data: dataProduk,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y', // Membuat bar menjadi horizontal agar nama produk mudah dibaca
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Terjual (Qty)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return 'Terjual: ' + new Intl.NumberFormat('id-ID').format(
                                            context.parsed.x);
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                const canvas = ctxProduk.canvas;
                ctxProduk.font = '16px Arial';
                ctxProduk.fillStyle = '#6B7280';
                ctxProduk.textAlign = 'center';
                ctxProduk.fillText('Tidak ada produk terjual bulan ini.', canvas.width / 2, 50);
            }
        });
    </script>
@endpush
