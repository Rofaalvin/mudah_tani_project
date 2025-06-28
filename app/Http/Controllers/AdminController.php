<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar semua admin.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Mulai query untuk user dengan role 'admin'
        $query = User::where('role', 'admin');

        // Jika ada kata kunci pencarian, terapkan filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        // Lakukan paginasi (misal: 10 per halaman) dan sertakan query string
        // pada link paginasi agar filter tetap aktif
        $admins = $query->latest()->paginate(10)->appends($request->query());

        // Kirim data ke view
        return view('admin.kelola_admin.index', compact('admins', 'search'));
    }

    /**
     * Menampilkan form tambah admin.
     */
    public function create()
    {
        return view('admin.kelola_admin.create'); // Pastikan file view ini ada
    }

    /**
     * Menyimpan admin baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:admin,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'admin';

        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit admin.
     */
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.kelola_admin.edit', compact('admin'));
    }

    /**
     * Memperbarui data admin berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:admin,email,' . $id . ',id_admin',
            'password' => 'nullable|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Menghapus admin berdasarkan ID.
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus');
    }
}
