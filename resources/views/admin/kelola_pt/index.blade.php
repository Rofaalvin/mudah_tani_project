@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kelola PT</h2>

    <!-- Tombol Tambah PT (Trigger Modal) -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPTModal">
        Tambah PT
    </button>

    <!-- Tabel PT -->
    <table class="table table-bordered">
        <thead class="table custom-header">
            <tr>
                <th>ID PT</th>
                <th>Nama PT</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pts as $pt)
            <tr>
                <td>{{ $pt->id_pt }}</td>
                <td>{{ $pt->nama_pt }}</td>
                <td>{{ $pt->alamat }}</td>
                <td>
                    <!-- Tombol Edit (Trigger Modal) -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPTModal{{ $pt->id_pt }}">
                        Edit
                    </button>

                    <!-- Form Hapus -->
                    <form action="{{ route('pt.destroy', $pt->id_pt) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus PT ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit PT -->
            <div class="modal fade" id="editPTModal{{ $pt->id_pt }}" tabindex="-1" aria-labelledby="editPTModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit PT</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('pt.update', $pt->id_pt) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">ID PT</label>
                                    <input type="text" class="form-control" name="id_pt" value="{{ $pt->id_pt }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama PT</label>
                                    <input type="text" class="form-control" name="nama_pt" value="{{ $pt->nama_pt }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" required>{{ $pt->alamat }}</textarea>
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

<!-- Modal Tambah PT -->
<div class="modal fade" id="tambahPTModal" tabindex="-1" aria-labelledby="tambahPTModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPTModalLabel">Tambah PT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pt.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_pt" class="form-label">ID PT</label>
                        <input type="text" class="form-control" id="id_pt" name="id_pt" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pt" class="form-label">Nama PT</label>
                        <input type="text" class="form-control" id="nama_pt" name="nama_pt" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
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
