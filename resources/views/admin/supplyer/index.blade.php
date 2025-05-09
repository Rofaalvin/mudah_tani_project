@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Data Supplyer</h1>

    <a href="{{ route('supplyer.create') }}" class="btn btn-primary mb-3">Tambah Supplyer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Supplyer</th>
                <th>Nama Supplyer</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id_supplyer }}</td>
                <td>{{ $supplier->nama_supplyer }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>
                    <a href="{{ route('supplyer.edit', $supplier->id_supplyer) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('supplyer.destroy', $supplier->id_supplyer) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
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
