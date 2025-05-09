<?php

namespace App\Http\Controllers;

use App\Models\Supplyer;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    public function index()
    {
        $suppliers = Supplyer::all();
        return view('admin.supplyer.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplyer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplyer' => 'required|unique:supplyer,id_supplyer',
            'nama_supplyer' => 'required|string|max:255',
            'alamat' => 'required',
        ]);

        Supplyer::create($request->only(['id_supplyer', 'nama_supplyer', 'alamat']));

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplyer::findOrFail($id);
        return view('admin.supplyer.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplyer' => 'required|string|max:255',
            'alamat' => 'required',
        ]);

        $supplier = Supplyer::findOrFail($id);
        $supplier->update($request->only(['nama_supplyer', 'alamat']));

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = Supplyer::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplyer.index')->with('success', 'Supplyer berhasil dihapus.');
    }
}
