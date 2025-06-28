@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Data Penjualan</h1>

        <a href="{{ route('data_penjualan.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

        <!-- Form Filter -->
        <div class="card shadow-sm mb-3">
            <div class="card-header">
                Filter Data Penjualan
            </div>
            <div class="card-body">
                <form action="{{ route('data_penjualan.index') }}" method="GET" class="row g-3 align-items-end">
                    {{-- Filter berdasarkan User/Pembeli --}}
                    <div class="col-md-4">
                        <label for="filter_user" class="form-label">Filter Berdasarkan Pembeli</label>
                        <select name="filter_user" id="filter_user" class="form-select">
                            <option value="">Semua Pembeli</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ ($filterUser ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter berdasarkan Bulan --}}
                    <div class="col-md-4">
                        <label for="month-picker" class="form-label">Filter Berdasarkan Bulan</label>
                        <input type="text" class="form-control" id="month-picker" name="filter_bulan"
                            value="{{ $filterBulan ?? '' }}" placeholder="Pilih bulan dan tahun...">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('data_penjualan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($dataPenjualans->isEmpty())
            <div class="alert alert-info">Belum ada data penjualan.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPenjualans as $penjualan)
                        <tr>
                            <td>{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->kode_trx_jual }}</td>
                            <td>{{ $penjualan->user->name ?? 'Tidak diketahui' }}</td>
                            <td>{{ $penjualan->nama_barang }}</td>
                            <td>{{ $penjualan->quantity }}</td>
                            <td>Rp{{ number_format($penjualan->harga, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($penjualan->total, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->tanggal }}</td>
                            <td>
                                <a href="{{ route('data_penjualan.edit', $penjualan->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('data_penjualan.destroy', $penjualan->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                        class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Tidak ada data penjualan yang cocok dengan filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Link Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $dataPenjualans->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    {{-- Script untuk Flatpickr (pemilih bulan) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#month-picker", {
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true, // Tampilkan nama bulan singkat: "Jan", "Feb"
                        dateFormat: "Y-m", // Format yang dikirim ke server: 2024-06
                        altFormat: "F Y", // Format yang dilihat pengguna: "Juni 2024"
                    })
                ]
            });
        });
    </script>
@endpush
