@extends('penjual.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Produk</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>

        {{-- Tambahkan field untuk deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk (kosongkan jika tidak diubah)</label>
            <input type="file" name="gambar" class="form-control">
            @if($produk->gambar)
                <div class="mt-2">
                    <img src="{{ asset($produk->gambar) }}" width="100" alt="Gambar Produk">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
