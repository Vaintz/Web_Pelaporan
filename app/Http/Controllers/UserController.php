<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan tabel dengan fitur Search & Filter Role
    public function index(Request $request)
    {
        $query = User::where('id', '!=', Auth::id());

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nim_nip', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Fitur Filter Program Studi
        if ($request->has('program_studi') && $request->program_studi != '') {
            $query->where('program_studi', $request->program_studi);
        }

        $users = $query->latest()->get();

        // AMBIL DATA PRODI DARI TABEL MASTER 'PRODIS'
        $listProdi = \App\Models\Prodi::all();

        return view('admin-biro.pengguna.index', compact('users', 'listProdi'));
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin-biro.pengguna.show', compact('user'));
    }

    // Menampilkan form edit user oleh admin biro
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $listProdi = \App\Models\Prodi::all(); // Ambil data prodi dari DB

        return view('admin-biro.pengguna.edit', compact('user', 'listProdi'));
    }

    // Menyimpan perubahan data user oleh admin biro
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:pelapor,admin_fakultas,admin_biro',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas' => 'nullable|string|max:100',
            'program_studi' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->role = $request->role;
        $user->nim_nip = $request->nim_nip;
        $user->fakultas = $request->fakultas;
        $user->program_studi = $request->program_studi;
        $user->no_hp = $request->no_hp;
        $user->save();

        return redirect()->route('admin.biro.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // (Fungsi create, store, dan toggleStatus yang sudah ada sebelumnya tetap di sini...)
    public function create()
    {
        // Ambil semua data prodi dari tabel master prodis
        $listProdi = \App\Models\Prodi::all();

        return view('admin-biro.pengguna.create', compact('listProdi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[^@\s]+@(mhs\.)?unimal\.ac\.id$/',
            ],
            'password' => 'required|min:8',
            'role' => 'required|in:pelapor,admin_fakultas,admin_biro',
            'nim_nip' => 'nullable|string|max:50',
            'fakultas' => 'nullable|string|max:100',
            'program_studi' => 'nullable|string|max:100',
        ], [
            'email.regex' => 'Gunakan email kampus UNIMAL yang valid (@unimal.ac.id atau @mhs.unimal.ac.id).',
            'email.unique' => 'Email ini sudah terdaftar di dalam sistem.',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
            'nim_nip' => $request->nim_nip,
            'fakultas' => $request->fakultas,
            'program_studi' => $request->program_studi,
            'status' => 'aktif', // Otomatis aktif saat dibuat
        ]);

        return redirect()->route('admin.biro.pengguna.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status === 'aktif') ? 'nonaktif' : 'aktif';
        $user->save();

        return back()->with('success', "Status akun {$user->name} berhasil diubah.");
    }
}