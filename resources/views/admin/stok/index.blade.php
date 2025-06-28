@extends('admin.layouts.app')

@section('content')
    <h1>Daftar Stok</h1>

    <!-- Form Pencarian -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="{{ route('stok.index') }}" method="GET" class="d-flex">
                <input type="search" name="search" class="form-control me-2"
                    placeholder="Cari berdasarkan nama atau ID produk..." value="{{ $search ?? '' }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="{{ route('stok.index') }}" class="btn btn-secondary ms-2">Reset</a>
            </form>
        </div>
    </div>

    @if (session('success'))
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
            @forelse($produks as $produk)
                <tr>
                    <td>{{ $produk->id_produk }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        @if (!empty($search))
                            Produk dengan kata kunci "{{ $search }}" tidak ditemukan.
                        @else
                            Tidak ada data stok produk.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {{ $produks->links() }}
    </div>
@endsection
