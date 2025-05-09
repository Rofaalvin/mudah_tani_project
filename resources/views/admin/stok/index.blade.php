@extends('admin.layouts.app')

@section('content')
    <h1>Daftar Stok</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
                <tr>
                    <td>{{ $produk->id_produk }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
