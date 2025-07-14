@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Data Penjualan (Detail Items)</h1>

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
            <!-- Summary Card -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Items</h5>
                            <h3>{{ $dataPenjualans->total() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Quantity</h5>
                            <h3>{{ $dataPenjualans->sum('quantity') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Nilai</h5>
                            <h3>Rp{{ number_format($dataPenjualans->sum('total'), 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Pembeli</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataPenjualans as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->kode_trx_jual }}</span>
                                </td>
                                <td>{{ $item->nama_pembeli }}</td>
                                <td>
                                    <strong>{{ $item->nama_barang }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $item->quantity }}</span>
                                </td>
                                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>
                                    <strong>Rp{{ number_format($item->total, 0, ',', '.') }}</strong>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Tidak ada data penjualan yang cocok dengan filter yang
                                            dipilih.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="d-flex justify-content-center">
                {{ $dataPenjualans->links() }}
            </div>

            <!-- Export Options -->
            {{-- <div class="mt-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                    <button type="button" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div> --}}
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

@push('styles')
    <style>
        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .badge {
            font-size: 0.85em;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
    </style>
@endpush
