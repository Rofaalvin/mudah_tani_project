@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Data Supplyer</h1>

        <a href="{{ route('supplyer.create') }}" class="btn btn-primary mb-3">
            Tambah Supplyer
        </a>

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('supplyer.index') }}" method="GET" class="d-flex">
                    <input type="search" name="search" class="form-control me-2"
                        placeholder="Cari supplier berdasarkan nama, alamat, atau ID..." value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <a href="{{ route('supplyer.index') }}" class="btn btn-secondary ms-2">Reset</a>
                </form>
            </div>
        </div>

        @if (session('success'))
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
                @forelse($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id_supplyer }}</td>
                        <td>{{ $supplier->nama_supplyer }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>
                            <a href="{{ route('supplyer.edit', $supplier->id_supplyer) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('supplyer.destroy', $supplier->id_supplyer) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            @if (!empty($search))
                                Supplier dengan kata kunci "{{ $search }}" tidak ditemukan.
                            @else
                                Tidak ada data supplier.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $suppliers->links() }}
    </div>
@endsection
