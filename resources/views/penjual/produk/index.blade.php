@extends('penjual.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Daftar Produk</h2>

        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

        <!-- Form Pencarian -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('produk.index') }}" method="GET" class="d-flex">
                    <input type="search" name="search" class="form-control me-2"
                        placeholder="Cari berdasarkan nama atau ID produk..." value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary ms-2">Reset</a>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $produk)
                    <tr>
                        <td>{{ $produk->id_produk }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        {{-- Tampilkan deskripsi, batasi 50 karakter --}}
                        <td>{{ Str::limit($produk->deskripsi, 50, '...') ?? '-' }}</td>
                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>
                            @if ($produk->gambar)
                                <img src="{{ asset($produk->gambar) }}" width="80" alt="Gambar Produk">
                            @else
                                <span class="text-muted">Tidak Ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('produk.edit', $produk->id_produk) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- Update colspan menjadi 7 --}}
                        <td colspan="7" class="text-center">
                            @if (!empty($search))
                                Produk dengan kata kunci "{{ $search }}" tidak ditemukan.
                            @else
                                Tidak ada data produk. Silakan tambah produk baru.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Link Paginasi -->
        <div class="d-flex justify-content-center mt-3">
            {{ $produks->links() }}
        </div>
    </div>
@endsection
