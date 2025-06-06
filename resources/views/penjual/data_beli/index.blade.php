@extends('penjual.layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Data Pembelian</h2>

<div class="btn-container">
    <a href="{{ url('/pembelian') }}" class="btn-green">Input Pembelian</a>
    <a href="{{ url('/data_beli') }}" class="btn-green">Lihat Data Pembelian</a>
</div>

@if(count($pembelianItems) > 0)
    <table class="table w-full border border-gray-400 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">Kode Transaksi</th>
                <th class="border px-2 py-1">Nama Supplier</th>
                <th class="border px-2 py-1">Tanggal</th>
                <th class="border px-2 py-1">Kode Barang</th>
                <th class="border px-2 py-1">Nama Barang</th>
                <th class="border px-2 py-1">Qty</th>
                <th class="border px-2 py-1">Harga</th>
                <th class="border px-2 py-1">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembelianItems as $item)
                <tr>
                    <td class="border px-2 py-1 text-center">{{ $item->kode_trx_beli }}</td>
                    <td class="border px-2 py-1 text-center">{{ $item->supplyer->nama_supplyer ?? '-' }}</td>
                    <td class="border px-2 py-1 text-center">{{ $item->tanggal }}</td>
                    <td class="border px-2 py-1 text-center">{{ $item->id_barang ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
                    <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                    <td class="border px-2 py-1 text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="border px-2 py-1 text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-gray-600 mt-4">Belum ada data pembelian.</p>
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