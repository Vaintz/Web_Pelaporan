<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index(Request $request)
    {
        $query = Gedung::withCount('ruangans');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $gedungs = $query->latest()->get();

        return view('admin-biro.gedung.index', compact('gedungs'));
    }

    public function create()
    {
        return view('admin-biro.gedung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:gedungs,nama',
        ], [
            'nama.required' => 'Nama gedung wajib diisi.',
            'nama.unique'   => 'Nama gedung ini sudah terdaftar.',
        ]);

        Gedung::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.biro.gedung.index')->with('success', 'Gedung berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('admin-biro.gedung.edit', compact('gedung'));
    }

    public function update(Request $request, $id)
    {
        $gedung = Gedung::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255|unique:gedungs,nama,' . $id,
        ], [
            'nama.required' => 'Nama gedung wajib diisi.',
            'nama.unique'   => 'Nama gedung ini sudah terdaftar.',
        ]);

        $gedung->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.biro.gedung.index')->with('success', 'Data gedung berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();

        return redirect()->route('admin.biro.gedung.index')->with('success', 'Gedung berhasil dihapus!');
    }
}