<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Teknisi::query();

        // Fitur Cari Nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $teknisis = $query->latest()->get();

        return view('admin-biro.teknisi.index', compact('teknisis'));
    }

    public function create()
    {
        return view('admin-biro.teknisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'status' => 'required|string|in:tersedia,tidak_tersedia',
        ], [
            'nama.required'   => 'Nama teknisi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
        ]);

        Teknisi::create([
            'nama'   => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.biro.teknisi.index')->with('success', 'Teknisi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $teknisi = Teknisi::findOrFail($id);
        return view('admin-biro.teknisi.edit', compact('teknisi'));
    }

    public function update(Request $request, $id)
    {
        $teknisi = Teknisi::findOrFail($id);

        $request->validate([
            'nama'   => 'required|string|max:255',
            'status' => 'required|string|in:tersedia,tidak_tersedia',
        ]);

        $teknisi->update([
            'nama'   => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.biro.teknisi.index')->with('success', 'Data teknisi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $teknisi = Teknisi::findOrFail($id);
        $teknisi->delete();

        return redirect()->route('admin.biro.teknisi.index')->with('success', 'Teknisi berhasil dihapus!');
    }
}