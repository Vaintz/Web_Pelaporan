<?php
namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    // 1. TAMPILKAN DATA PRODI (DENGAN SEARCH & FILTER)
    public function index(Request $request)
    {
        $query = Prodi::query();

        // Fitur Pencarian Nama Prodi
        if ($request->filled('search')) {
            $query->where('nama_prodi', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter Jenjang
        if ($request->filled('jenjang')) {
            $query->where('jenjang', $request->jenjang);
        }

        $prodis = $query->latest()->get();

        return view('admin-biro.prodi.index', compact('prodis'));
    }

    // 2. FORM TAMBAH PRODI
    public function create()
    {
        return view('admin-biro.prodi.create');
    }

    // 3. SIMPAN DATA PRODI BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi',
            'jenjang'    => 'required|string|max:10',
        ], [
            'nama_prodi.required' => 'Nama Program Studi wajib diisi.',
            'nama_prodi.unique'   => 'Nama Program Studi tersebut sudah ada.',
            'jenjang.required'    => 'Jenjang wajib dipilih.',
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
            'jenjang'    => $request->jenjang,
        ]);

        return redirect()->route('admin.biro.prodi.index')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    // 4. FORM EDIT PRODI
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin-biro.prodi.edit', compact('prodi'));
    }

    // 5. UPDATE DATA PRODI
    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi,' . $id,
            'jenjang'    => 'required|string|max:10',
        ], [
            'nama_prodi.required' => 'Nama Program Studi wajib diisi.',
            'nama_prodi.unique'   => 'Nama Program Studi tersebut sudah ada.',
            'jenjang.required'    => 'Jenjang wajib dipilih.',
        ]);

        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
            'jenjang'    => $request->jenjang,
        ]);

        return redirect()->route('admin.biro.prodi.index')->with('success', 'Program Studi berhasil diperbarui!');
    }

    // 6. HAPUS DATA PRODI
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->route('admin.biro.prodi.index')->with('success', 'Program Studi berhasil dihapus!');
    }
}