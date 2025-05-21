@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola Penjual</h2>

    <!-- Tombol Tambah Penjual (Trigger Modal) -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPenjualModal">
        Tambah Penjual
    </button>

    <!-- Tabel Penjual -->
    <table class="table table-bordered">
        <thead class="table custom-header">
            <tr>
                <th>ID Penjual</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjuals as $penjual)
            <tr>
                <td>{{ $penjual->id }}</td>
                <td>{{ $penjual->name }}</td>
                <td>{{ $penjual->email }}</td>
                <td>{{ $penjual->no_hp ?? '-' }}</td>
                <td>{{ $penjual->alamat ?? '-' }}</td>
                <td>
                    <!-- Tombol Edit (Trigger Modal) -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPenjualModal{{ $penjual->id }}">
                        Edit
                    </button>

                    <!-- Form Hapus -->
                    <form action="{{ route('penjual.destroy', $penjual->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus penjual ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Penjual -->
            <div class="modal fade" id="editPenjualModal{{ $penjual->id }}" tabindex="-1" aria-labelledby="editPenjualModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Penjual</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('penjual.update', $penjual->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">ID Penjual</label>
                                    <input type="text" class="form-control" name="id_penjual" value="{{ $penjual->id }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{ $penjual->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $penjual->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="{{ $penjual->no_hp }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat">{{ $penjual->alamat }}</textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Penjual -->
<div class="modal fade" id="tambahPenjualModal" tabindex="-1" aria-labelledby="tambahPenjualModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenjualModalLabel">Tambah Penjual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penjual.store') }}" method="POST">
                    @csrf
                    {{-- <div class="mb-3">
                        <label for="id_penjual" class="form-label">ID Penjual</label>
                        <input type="text" class="form-control" id="id_penjual" name="id_penjual" required>
                    </div> --}}
                    <div class="mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="numeric" class="form-control" id="no_hp" name="no_hp">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
