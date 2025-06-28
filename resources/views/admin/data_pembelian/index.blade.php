@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Pembelian</h1>
        <a href="{{ route('admin.data_pembelian.seeder') }}" class="btn btn-primary"
            onclick="return confirm('Yakin ingin menjalankan ulang seeder? Data akan di-reset!')">
            Refresh!
        </a>
    </div>

    <!-- Form Filter Bulan -->
    <div class="card mb-4">
        <div class="card-header">
            Filter Data
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('data_pembelian.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="filter_bulan" class="form-label">Pilih Bulan & Tahun</label>
                    <input type="text" class="form-control" id="month-picker" name="filter_bulan"
                        value="{{ $filterBulan ?? '' }}" placeholder="Pilih bulan...">
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('data_pembelian.index') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data_pembelian as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->kode_trx_beli }}</td>
                        <td>{{ $data->nama_barang }}</td>
                        <td>{{ $data->supplyer->nama_supplyer ?? '-' }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($data->total, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data pembelian</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $data_pembelian->links() }}
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#month-picker", {
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "Y-m",
                        altFormat: "F Y",
                    })
                ]
            });
        });
    </script>
@endpush
