@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('content')
    <div style="max-width: 800px; display: flex; flex-direction: column; gap: 20px;">

        <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h2 style="margin: 0 0 25px 0; color: #1a1a2e; font-size: 20px; font-weight: 700; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
                Edit Profil
            </h2>

            <!-- Menampilkan pesan error validasi -->
            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- LOGIKA MENENTUKAN LABEL IDENTITAS -->
            @php
                $labelIdentitas = 'NIP';
                if ($user->role === 'pelapor') {
                    if (str_ends_with($user->email, '@mhs.unimal.ac.id')) {
                        $labelIdentitas = 'Nomor Induk Mahasiswa (NIM)';
                    } else {
                        $labelIdentitas = 'NIP / NIDN';
                    }
                }
            @endphp

            <!-- Form update -->
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display: flex; gap: 35px; flex-wrap: wrap;">

                    <!-- Bagian Kiri: Input Teks -->
                    <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; gap: 16px;">
                        
                        <!-- Nama Lengkap (Bisa Diubah) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;" required>
                        </div>

                        <!-- Email (Disabled) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Email (Tidak dapat diubah)</label>
                            <input type="email" value="{{ $user->email }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; background: #f8fafc; color: #94a3b8;" disabled>
                        </div>

                        <!-- NIM/NIP (Disabled) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">
                                {{ $labelIdentitas }} (Tidak dapat diubah)
                            </label>
                            <input type="text" value="{{ $user->nim_nip }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; background: #f8fafc; color: #94a3b8;" disabled>
                        </div>

                        <!-- Fakultas (Disabled) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Fakultas (Tidak dapat diubah)</label>
                            <input type="text" value="{{ $user->fakultas }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; background: #f8fafc; color: #94a3b8;" disabled>
                        </div>

                        <!-- Program Studi (Disabled) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 6px;">Program Studi (Tidak dapat diubah)</label>
                            <input type="text" value="{{ $user->program_studi }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; background: #f8fafc; color: #94a3b8;" disabled>
                        </div>

                        <!-- Nomor HP (Bisa Diubah) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nomor HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;">
                        </div>

                        <!-- Alamat (Bisa Diubah) -->
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Alamat</label>
                            <textarea name="alamat" rows="3"
                                style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none; font-family: inherit;">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>
                    </div>

                    <!-- Bagian Kanan: Foto Profil -->
                    <div style="width: 220px; display: flex; flex-direction: column; align-items: center; text-align: center;">
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 12px;">Foto Profil</label>

                        <div style="width: 110px; height: 110px; border-radius: 50%; overflow: hidden; background: #eef2f3; border: 3px solid #eef2f3; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; justify-content: center; align-items: center; margin-bottom: 14px;">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <span style="color: #888; font-size: 14px; font-weight: 600;">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            @endif
                        </div>

                        <input type="file" name="profile_photo" accept="image/*" style="width: 100%; font-size: 12px; color: #64748b;">
                        <span style="font-size: 11px; color: #94a3b8; margin-top: 6px;">Format JPG/PNG, maks. 5MB</span>
                    </div>

                </div>

                <!-- Tombol Bawah -->
                <div style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 20px; display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
                    <a href="{{ route($user->role === 'admin_fakultas' ? 'admin.fakultas.profil' : ($user->role === 'admin_biro' ? 'admin.biro.profil' : 'pelapor.profil')) }}"
                        style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px 18px;">
                        Batal
                    </a>
                    <button type="submit"
                        style="background: #212035; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 13px; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection