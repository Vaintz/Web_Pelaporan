@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
    <div style="max-width: 800px; display: flex; flex-direction: column; gap: 20px;">

        <!-- NOTIFIKASI SUKSES (OPSIONAL KALAU ADA) -->
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 12px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                <span>✓</span> {{ session('success') }}
            </div>
        @endif

        <!-- CARD UTAMA: PROFIL (CLEAN & MODERN) -->
        <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; justify-content: space-between; gap: 30px; flex-wrap: wrap;">

            <!-- Sisi Kiri: Foto + Identitas Singkat -->
            <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                <div style="position: relative;">
                    <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: #eef2f3; border: 3px solid #eef2f3; box-shadow: 0 4px 10px rgba(0,0,0,0.08); display: flex; justify-content: center; align-items: center;">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="color: #888; font-size: 13px; font-weight: 600;">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        @endif
                    </div>
                </div>

                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                        <h2 style="margin: 0; color: #1a1a2e; font-size: 20px; font-weight: 700;">{{ $user->name }}</h2>
                        <span style="background: #eef2f3; color: #212035; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            {{ str_replace('_', ' ', $user->role) }}
                        </span>
                    </div>
                    <p style="margin: 0; color: #666; font-size: 13px;">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Sisi Kanan: Tombol Edit -->
            <div>
                <a href="{{ route('profil.edit') }}" style="background: #212035; color: white; text-decoration: none; padding: 10px 22px; border-radius: 12px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: 0.2s; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
                    Edit Profil
                </a>
            </div>
        </div>

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

        <!-- CARD DETAIL INFORMASI (Gaya List Bersih) -->
        <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h3 style="margin: 0 0 20px 0; color: #1a1a2e; font-size: 16px; font-weight: 700;">Detail Informasi</h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
                
                <!-- Identitas Utama (NIM/NIP) -->
                <div style="background: #f8fafc; padding: 16px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
                    <span style="display: block; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                        {{ $labelIdentitas }}
                    </span>
                    <span style="font-size: 15px; color: #1e293b; font-weight: 600;">{{ $user->nim_nip ?? 'Belum diisi' }}</span>
                </div>

                <!-- Nomor HP -->
                <div style="background: #f8fafc; padding: 16px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
                    <span style="display: block; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                        Nomor HP / WhatsApp
                    </span>
                    <span style="font-size: 15px; color: #1e293b; font-weight: 600;">{{ $user->no_hp ?? 'Belum diisi' }}</span>
                </div>

                <!-- Fakultas -->
                <div style="background: #f8fafc; padding: 16px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
                    <span style="display: block; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                        Fakultas
                    </span>
                    <span style="font-size: 15px; color: #1e293b; font-weight: 600;">{{ $user->fakultas ?? 'Belum diisi' }}</span>
                </div>

                <!-- Program Studi -->
                <div style="background: #f8fafc; padding: 16px 20px; border-radius: 14px; border: 1px solid #f1f5f9;">
                    <span style="display: block; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                        Program Studi
                    </span>
                    <span style="font-size: 15px; color: #1e293b; font-weight: 600;">{{ $user->program_studi ?? 'Belum diisi' }}</span>
                </div>

                <!-- Alamat -->
                <div style="background: #f8fafc; padding: 16px 20px; border-radius: 14px; border: 1px solid #f1f5f9; grid-column: span 2;">
                    <span style="display: block; font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; margin-bottom: 4px;">
                        Alamat 
                    </span>
                    <span style="font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">{{ $user->alamat ?? 'Belum diisi' }}</span>
                </div>
            </div>
        </div>

        <!-- CARD GANTI PASSWORD -->
        <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <div style="margin-bottom: 20px;">
                <h3 style="margin: 0 0 4px 0; color: #1a1a2e; font-size: 16px; font-weight: 700;">Keamanan & Password</h3>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Pastikan menggunakan password yang kuat dan mudah diingat.</p>
            </div>

            @if(session('password_success'))
                <div style="background: #d4edda; color: #155724; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px; font-weight: 500;">
                    ✓ {{ session('password_success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ str_replace(')', '', $error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profil.password') }}" method="POST" style="max-width: 500px;">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password Lama</label>
                    <input type="password" name="current_password" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;" placeholder="Masukkan password saat ini" required>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password Baru</label>
                    <input type="password" name="password" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;" placeholder="Minimal 8 karakter" required>
                </div>

                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;" placeholder="Ulangi password baru" required>
                </div>

                <button type="submit" style="background: #334155; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 13px; transition: 0.2s;">
                    Perbarui Password
                </button>
            </form>
        </div>

    </div>
@endsection