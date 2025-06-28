@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Kelola Admin</h2>

        <!-- Tombol Tambah Admin (Trigger Modal) -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAdminModal">
            Tambah Admin
        </button>

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('admin.index') }}" method="GET" class="d-flex">
                    <input type="search" name="search" class="form-control me-2"
                        placeholder="Cari admin berdasarkan nama, email, atau no hp..." value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary ms-2">Reset</a>
                </form>
            </div>
        </div>

        <!-- Tabel Admin -->
        <table class="table table-bordered">
            <thead class="table custom-header">
                <tr>
                    <th>ID Admin</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Password</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->no_hp ?? '-' }}</td>
                        <td>{{ $admin->password }}</td>
                        <td>{{ $admin->alamat ?? '-' }}</td>
                        <td>
                            <!-- Tombol Edit (Trigger Modal) -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editAdminModal{{ $admin->id }}">
                                Edit
                            </button>

                            <!-- Form Hapus -->
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Admin -->
                    <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1"
                        aria-labelledby="editAdminModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Admin</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label class="form-label">name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $admin->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $admin->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password (kosongkan jika tidak diubah)</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">No HP</label>
                                            <input type="text" class="form-control" name="no_hp"
                                                value="{{ $admin->no_hp }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat">{{ $admin->alamat }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            @if (!empty($search))
                                Admin dengan kata kunci "{{ $search }}" tidak ditemukan.
                            @else
                                Tidak ada data admin.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $admins->links() }}
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="tambahAdminModal" tabindex="-1" aria-labelledby="tambahAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahAdminModalLabel">Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
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
