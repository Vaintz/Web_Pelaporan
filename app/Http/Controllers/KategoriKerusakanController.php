<?php

namespace App\Http\Controllers;

use App\Models\KategoriKerusakan;
use Illuminate\Http\Request;

class KategoriKerusakanController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriKerusakan::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kategoris = $query->latest()->get();

        return view('admin-biro.kategori-kerusakan.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin-biro.kategori-kerusakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_kerusakans,nama',
        ], [
            'nama.required' => 'Nama kategori kerusakan wajib diisi.',
            'nama.unique'   => 'Nama kategori kerusakan ini sudah ada.',
        ]);

        KategoriKerusakan::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.biro.kategori-kerusakan.index')->with('success', 'Kategori kerusakan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = KategoriKerusakan::findOrFail($id);
        return view('admin-biro.kategori-kerusakan.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriKerusakan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_kerusakans,nama,' . $id,
        ], [
            'nama.required' => 'Nama kategori kerusakan wajib diisi.',
            'nama.unique'   => 'Nama kategori kerusakan ini sudah ada.',
        ]);

        $kategori->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.biro.kategori-kerusakan.index')->with('success', 'Kategori kerusakan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriKerusakan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.biro.kategori-kerusakan.index')->with('success', 'Kategori kerusakan berhasil dihapus!');
    }
}