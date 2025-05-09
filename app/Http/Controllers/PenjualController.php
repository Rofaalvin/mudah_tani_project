<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjual;
use Illuminate\Support\Facades\Hash;

class PenjualController extends Controller
{
    /**
     * Menampilkan daftar semua penjual.
     */
    public function index()
    {
        $penjuals = Penjual::all();
        return view('admin.kelola_penjual.index', compact('penjuals'));
    }

    /**
     * Menampilkan form tambah penjual.
     */
    public function create()
    {
        return view('admin.kelola_penjual.create'); // Pastikan file view ini ada
    }

    /**
     * Menyimpan penjual baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penjual' => 'required|string|unique:penjual,id_penjual',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|unique:penjual,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Penjual::create($validated);

        return redirect()->route('penjual.index')->with('success', 'Penjual berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit penjual.
     */
    public function edit($id)
    {
        $penjual = Penjual::findOrFail($id);
        return view('admin.kelola_penjual.edit', compact('penjual'));
    }

    /**
     * Memperbarui data penjual berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $penjual = Penjual::findOrFail($id);

        $validated = $request->validate([
            'username' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:penjual,email,' . $id . ',id_penjual',
            'password' => 'nullable|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $penjual->update($validated);

        return redirect()->route('penjual.index')->with('success', 'Penjual berhasil diperbarui');
    }

    /**
     * Menghapus penjual berdasarkan ID.
     */
    public function destroy($id)
    {
        $penjual = Penjual::findOrFail($id);
        $penjual->delete();

        return redirect()->route('penjual.index')->with('success', 'Penjual berhasil dihapus');
    }
}
