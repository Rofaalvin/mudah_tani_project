@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Penjualan</h1>

    <a href="{{ route('data_penjualan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($dataPenjualans->isEmpty())
        <div class="alert alert-info">Belum ada data penjualan.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataPenjualans as $penjualan)
                    <tr>
                        <td>{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->kode_trx_jual }}</td>
                        <td>{{ $penjualan->user->name ?? 'Tidak diketahui' }}</td>
                        <td>{{ $penjualan->nama_barang }}</td>
                        <td>{{ $penjualan->quantity }}</td>
                        <td>Rp{{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($penjualan->total, 0, ',', '.') }}</td>
                        <td>{{ $penjualan->tanggal }}</td>
                        <td>
                            <a href="{{ route('data_penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('data_penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
