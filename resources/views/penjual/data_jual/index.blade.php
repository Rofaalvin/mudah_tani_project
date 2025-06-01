@extends('penjual.layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Data Penjualan</h2>

<div class="btn-container">
    <a href="{{ url('/penjualan') }}" class="btn-green">Input Penjualan</a>
    <a href="{{ url('/data_jual') }}" class="btn-green">Lihat Data Penjualan</a>
</div>

@if(count($penjualans) > 0)
    @foreach($penjualans as $penjualan)
        <div class="mb-6 border border-gray-300 rounded-lg overflow-hidden shadow-sm bg-white">
            <div class="px-4 py-2 bg-gray-100 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <span class="font-semibold">Kode Transaksi:</span> {{ $penjualan->kode_trx_jual }}<br>
                    <span class="font-semibold">Nama Pembeli:</span> {{ $penjualan->user->name ?? '-' }}<br>
                    <span class="font-semibold">Tanggal:</span> {{ $penjualan->tanggal }}<br>
                    <span class="font-semibold">Status:</span> {{ $penjualan->status }}
                </div>
                <div class="mt-2 md:mt-0">
                    <span class="font-semibold">Total:</span>
                    <span class="text-green-700 font-bold">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</span>
                </div>
            </div>
            @if($penjualan->items && count($penjualan->items) > 0)
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
                        @foreach($penjualan->items as $item)
                            <tr>
                                <td class="border px-2 py-1 text-center">{{ $item->id_produk ?? '-' }}</td>
                                <td class="border px-2 py-1">{{ $item->nama_produk }}</td>
                                <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="border px-2 py-1 text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-4 py-2 text-gray-500">Tidak ada item pada penjualan ini.</div>
            @endif
        </div>
    @endforeach
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