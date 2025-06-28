@extends('penjual.layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Data Penjualan</h2>

    <div class="btn-container">
        <a href="{{ url('/penjualan') }}" class="btn-green">Input Penjualan</a>
        <a href="{{ url('/data_jual') }}" class="btn-green">Lihat Data Penjualan</a>
    </div>

    <div class="mb-4">
        <form action="{{ route('data_jual.index') }}" method="GET" class="flex items-center">
            <input type="search" name="search"
                class="border border-gray-300 rounded-l px-2 py-1 w-full md:w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Cari kode transaksi, nama pembeli, atau nama produk..." value="{{ $search ?? '' }}">
            <button type="submit" class="bg-gray-700 text-white px-4 py-1 rounded-r hover:bg-gray-800">Cari</button>
            <a href="{{ route('data_jual.index') }}" class="text-sm text-gray-600 hover:text-gray-900 ml-4">Reset</a>
        </form>
    </div>

    @if (count($penjualans) > 0)
        @forelse($penjualans as $penjualan)
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
                                {{ $penjualan->delivery_method == 'pickup' ? 'Diantar' : 'Diambil di Toko' }}
                            </span>
                        </p>
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
