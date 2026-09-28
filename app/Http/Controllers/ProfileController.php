<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // 1. Menampilkan halaman TAMPILAN AWAL (read-only + form ganti password)
    public function show()
    {
        $user = Auth::user();

        if ($user->role === 'pelapor') {
            return view('pelapor.profil.show', compact('user'));
        } elseif ($user->role === 'admin_fakultas') {
            return view('admin-fakultas.profil.show', compact('user'));
        } elseif ($user->role === 'admin_biro') {
            return view('admin-biro.profil.show', compact('user'));
        }

        abort(403, 'Akses tidak diizinkan.');
    }

    // 2. Menampilkan halaman FORM EDIT profil
    public function edit()
    {
        $user = Auth::user();

        if ($user->role === 'pelapor') {
            return view('pelapor.profil.edit', compact('user'));
        } elseif ($user->role === 'admin_fakultas') {
            return view('admin-fakultas.profil.edit', compact('user'));
        } elseif ($user->role === 'admin_biro') {
            return view('admin-biro.profil.edit', compact('user'));
        }

        abort(403, 'Akses tidak diizinkan.');
    }

    // 3. Proses menyimpan perubahan data teks & foto profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'nim_nip' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|max:5120',
        ]);

        // Jika user mengunggah foto baru
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }
            // Simpan foto baru ke folder storage/app/public/profile_photos
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        // Simpan data teks
        $user->name = $request->name;
        $user->nim_nip = $request->nim_nip;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        $user->save();

        // Redirect langsung ke halaman show masing-masing role
        $redirectRoute = match ($user->role) {
            'admin_fakultas' => 'admin.fakultas.profil',
            'admin_biro' => 'admin.biro.profil',
            default => 'pelapor.profil',
        };

        return redirect()->route($redirectRoute)->with('success', 'Profil berhasil diperbarui!');
    }

    // 4. Proses Ganti Password Langsung
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('password_success', 'Password berhasil diganti!');
    }
}