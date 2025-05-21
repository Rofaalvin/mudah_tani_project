<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Penjual;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PenjualController extends Controller
{
    /**
     * Menampilkan daftar semua penjual.
     */
    public function index()
    {
        $penjuals = User::where('role', 'penjual')->get();
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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6',
                'no_hp' => 'nullable|numeric|digits_between:1,15',
                'alamat' => 'nullable|string',
            ]);

            $validated['password'] = Hash::make($validated['password']);
            $validated['role'] = 'penjual';

            User::create($validated);

            return redirect()->route('penjual.index')->with('success', 'Penjual berhasil ditambahkan.');
        } catch (QueryException $e) {
            Log::error('QueryException saat menambahkan penjual: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan pada database. Silakan coba lagi.');
        } catch (\Exception $e) {
            Log::error('Exception saat menambahkan penjual: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan form edit penjual.
     */
    public function edit($id)
    {
        $penjual = User::findOrFail($id);
        return view('admin.kelola_penjual.edit', compact('penjual'));
    }

    /**
     * Memperbarui data penjual berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $penjual = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $id . ',id',
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
        $penjual = User::findOrFail($id);
        $penjual->delete();

        return redirect()->route('penjual.index')->with('success', 'Penjual berhasil dihapus');
    }
}
