@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola Pembeli</h2>

    <!-- Tombol Tambah Pembeli (Trigger Modal) -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPembeliModal">
        Tambah Pembeli
    </button>

    <!-- Tabel Pembeli -->
    <table class="table table-bordered">
        <thead class="table custom-header">
            <tr>
                <th>ID Pembeli</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Password</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelis as $pembeli)
            <tr>
                <td>{{ $pembeli->id_pembeli }}</td>
                <td>{{ $pembeli->nama_pembeli }}</td>
                <td>{{ $pembeli->email }}</td>
                <td>{{ $pembeli->no_hp ?? '-' }}</td>
                <td>{{ $pembeli->password}}</td>
                <td>{{ $pembeli->alamat ?? '-' }}</td>
                <td>
                    <!-- Tombol Edit (Trigger Modal) -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPembeliModal{{ $pembeli->id_pembeli }}">
                        Edit
                    </button>

                    <!-- Form Hapus -->
                    <form action="{{ route('pembeli.destroy', $pembeli->id_pembeli) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pembeli ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Pembeli -->
            <div class="modal fade" id="editPembeliModal{{ $pembeli->id_pembeli }}" tabindex="-1" aria-labelledby="editPembeliModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Pembeli</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('pembeli.update', $pembeli->id_pembeli) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama_pembeli" value="{{ $pembeli->nama_pembeli }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $pembeli->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="{{ $pembeli->no_hp }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat">{{ $pembeli->alamat }}</textarea>
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

<!-- Modal Tambah Pembeli -->
<div class="modal fade" id="tambahPembeliModal" tabindex="-1" aria-labelledby="tambahPembeliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPembeliModalLabel">Tambah Pembeli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembeli.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_pembeli" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
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
                        <input type="text" class="form-control" id="no_hp" name="no_hp">
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
