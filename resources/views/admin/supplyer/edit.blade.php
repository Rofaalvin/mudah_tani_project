@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Supplyer</h1>

    <form action="{{ route('supplyer.update', $supplier->id_supplyer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_supplyer" class="form-label">ID Supplyer</label>
            <input type="text" class="form-control" id="id_supplyer" name="id_supplyer" value="{{ $supplier->id_supplyer }}" disabled>
        </div>

        <div class="mb-3">
            <label for="nama_supplyer" class="form-label">Nama Supplyer</label>
            <input type="text" class="form-control" id="nama_supplyer" name="nama_supplyer" value="{{ $supplier->nama_supplyer }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $supplier->alamat }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('supplyer.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
