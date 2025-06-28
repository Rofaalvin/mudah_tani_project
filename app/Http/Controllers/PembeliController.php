<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PembeliController extends Controller
{
    /**
     * Menampilkan daftar semua pembeli.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Mulai query untuk user dengan role 'pembeli'
        $query = User::where('role', 'pembeli');

        // Jika ada kata kunci pencarian, terapkan filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Ambil data dengan paginasi (misal: 10 per halaman) dan urutkan
        // dari yang terbaru. Sertakan juga query string pada link paginasi.
        $pembelis = $query->latest()->paginate(10)->appends($request->query());

        // Kirim data yang sudah difilter dan dipaginasi ke view
        return view('admin.kelola_pembeli.index', compact('pembelis', 'search'));
    }

    /**
     * Menampilkan form tambah pembeli.
     */
    public function create()
    {
        return view('admin.kelola_pembeli.create'); // Pastikan file view ini ada
    }

    /**
     * Menyimpan pembeli baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pembeli';

        User::create($validated);

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil ditambahkan');
    }


    /**
     * Menampilkan form edit pembeli.
     */
    public function edit($id)
    {
        $pembeli = User::findOrFail($id);
        return view('admin.kelola_pembeli.edit', compact('pembeli'));
    }

    /**
     * Memperbarui data pembeli berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $pembeli = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:pembeli,email,' . $id . ',id_pembeli',
            'password' => 'nullable|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);


        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $pembeli->update($validated);

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil diperbarui');
    }

    /**
     * Menghapus pembeli berdasarkan ID.
     */
    public function destroy($id)
    {
        $pembeli = User::findOrFail($id);
        $pembeli->delete();

        return redirect()->route('pembeli.index')->with('success', 'Pembeli berhasil dihapus');
    }
}
