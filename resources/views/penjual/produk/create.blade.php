@extends('penjual.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Produk</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        {{-- Tambahkan field untuk deskripsi --}}
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
