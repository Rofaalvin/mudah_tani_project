@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Data Penjualan</h1>

    <a href="{{ route('data_penjualan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Transaksi</th>
                <th>ID Barang</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataPenjualans as $penjualan)
                <tr>
                    <td>{{ $penjualan->id_data_jual }}</td>
                    <td>{{ $penjualan->kode_trx_jual }}</td>
                    <td>{{ $penjualan->id_barang }}</td>
                    <td>{{ $penjualan->harga }}</td>
                    <td>
                        <a href="{{ route('data_penjualan.edit', $penjualan->id_data_jual) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('data_penjualan.destroy', $penjualan->id_data_jual) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
