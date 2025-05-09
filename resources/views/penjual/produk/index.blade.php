@extends('penjual.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Produk</h2>

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td>{{ $produk->id_produk }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td>{{ $produk->stok }}</td>
                <td>
                    @if($produk->gambar)
                        <img src="{{ asset($produk->gambar) }}" width="80" alt="Gambar Produk">
                    @else
                        <span class="text-muted">Tidak Ada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
