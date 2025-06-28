@extends('penjual.layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Data Pembelian</h2>

    <div class="btn-container">
        <a href="{{ url('/pembelian') }}" class="btn-green">Input Pembelian</a>
        <a href="{{ url('/data_beli') }}" class="btn-green">Lihat Data Pembelian</a>
    </div>

    <!-- Form Pencarian -->
    <div class="mb-4">
        <form action="{{ route('data_beli.index') }}" method="GET" class="flex items-center">
            <input type="search" name="search"
                class="border border-gray-300 rounded-l px-2 py-1 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Cari kode, nama barang, atau supplier..." value="{{ $search ?? '' }}">
            <button type="submit" class="bg-gray-700 text-white px-4 py-1 rounded-r hover:bg-gray-800">Cari</button>
            <a href="{{ route('data_beli.index') }}" class="text-sm text-gray-600 hover:text-gray-900 ml-4">Reset</a>
        </form>
    </div>

    {{-- PERBAIKAN: Ganti @forelse dengan @if untuk memeriksa data yang dikelompokkan --}}
    @if ($pembelianItems->isNotEmpty())
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
                    {{-- Loop luar yang benar untuk setiap transaksi (grup) --}}
                    @foreach ($pembelianItems as $kode_trx => $items)
                        @php
                            // Ambil data transaksi dari item pertama (karena semuanya sama dalam satu grup)
                            $firstItem = $items->first();
                            $rowspan = count($items);
                        @endphp
                        {{-- Loop dalam untuk setiap item di dalam transaksi --}}
                        @foreach ($items as $item)
                            <tr>
                                {{-- Tampilkan info transaksi hanya di baris pertama dengan rowspan --}}
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

                                {{-- Info spesifik per item --}}
                                <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
                                <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->total, 0, ',', '.') }}
                                </td>

                                {{-- Tampilkan info final transaksi hanya di baris pertama dengan rowspan --}}
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
        {{-- Ini adalah blok 'else' dari @if di atas --}}
        <p class="text-gray-600 mt-4">
            @if (!empty($search))
                Tidak ada data pembelian yang cocok dengan kata kunci "{{ $search }}".
            @else
                Belum ada data pembelian.
            @endif
        </p>
    @endif

    {{-- Style tidak perlu diubah --}}
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
