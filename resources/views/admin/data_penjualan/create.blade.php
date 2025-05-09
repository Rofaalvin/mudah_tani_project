@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Penjualan</h1>

    <form action="{{ route('data_penjualan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_trx_jual" class="form-label">Kode Transaksi</label>
            <input type="text" name="kode_trx_jual" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_barang" class="form-label">ID Barang</label>
            <input type="text" name="id_barang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('data_penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
