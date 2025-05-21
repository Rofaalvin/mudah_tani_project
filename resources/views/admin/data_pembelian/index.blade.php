@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Data Pembelian</h1>
        <a href="{{ route('admin.data_pembelian.seeder') }}" class="btn btn-primary"
            onclick="return confirm('Yakin ingin menjalankan ulang seeder? Data akan di-reset!')">
            Refresh!
        </a>
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
