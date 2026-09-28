@extends('layouts.dashboard')

@section('title', 'Manajemen Pengguna')

@section('content')
    <div style="max-width: 1050px; display: flex; flex-direction: column; gap: 20px;">

        <!-- HEADER & TOMBOL TAMBAH -->
        <div
            style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h2 style="margin: 0 0 5px 0; color: #1a1a2e; font-size: 20px; font-weight: 700;">Manajemen Pengguna</h2>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Kelola akun, pencarian, filter kategori, dan status
                    akses pengguna sistem.</p>
            </div>
            <a href="{{ route('admin.biro.pengguna.create') }}"
                style="background: #212035; color: white; text-decoration: none; padding: 10px 20px; border-radius: 12px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
                + Tambah Pengguna
            </a>
        </div>

        <!-- NOTIFIKASI -->
        @if (session('success'))
            <div
                style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 12px; font-size: 14px; font-weight: 500;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- FILTER & SEARCH BAR -->
        <div style="background: white; padding: 20px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <form action="{{ route('admin.biro.pengguna.index') }}" method="GET"
                style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">

                <!-- Input Search -->
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau NIM/NIP..."
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none;">
                </div>

                <!-- Filter Kategori / Role -->
                <div style="width: 180px;">
                    <select name="role"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none; background: white;">
                        <option value="">Semua Role</option>
                        <option value="pelapor" {{ request('role') == 'pelapor' ? 'selected' : '' }}>Pelapor</option>
                        <option value="admin_fakultas" {{ request('role') == 'admin_fakultas' ? 'selected' : '' }}>Admin
                            Fakultas</option>
                        <option value="admin_biro" {{ request('role') == 'admin_biro' ? 'selected' : '' }}>Admin Biro
                        </option>
                    </select>
                </div>

                <!-- Filter Program Studi -->
                <div style="width: 220px;">
                    <select name="program_studi"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none; background: white;">
                        <option value="">Semua Program Studi</option>
                        @if (isset($listProdi))
                            @foreach ($listProdi as $prodi)
                                <option value="{{ $prodi->nama_prodi }}"
                                    {{ request('program_studi') == $prodi->nama_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <!-- Tombol Filter -->
                <button type="submit"
                    style="background: #334155; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;">
                    Filter
                </button>

                @if (request('search') || request('role') || request('program_studi'))
                    <a href="{{ route('admin.biro.pengguna.index') }}"
                        style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px;">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- TABEL DATA PENGGUNA -->
        <div
            style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr
                        style="border-bottom: 2px solid #f1f5f9; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 10px;">Pengguna (NIM/NIP & Nama)</th>
                        <th style="padding: 12px 10px;">Role</th>
                        <th style="padding: 12px 10px;">Fakultas / Prodi</th>
                        <th style="padding: 12px 10px;">Status</th>
                        <th style="padding: 12px 10px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <!-- Kolom Pengguna: NIM/NIP di Atas, Nama di Bawah -->
                            <td style="padding: 15px 10px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 38px; height: 38px; border-radius: 50%; overflow: hidden; background: #eef2f3; flex-shrink: 0; display: flex; justify-content: center; align-items: center;">
                                        @if ($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span
                                                style="color: #64748b; font-size: 11px; font-weight: 700;">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #1e293b; font-size: 13px; margin-bottom: 2px;">
                                            {{ $user->nim_nip ?? 'Belum ada NIM/NIP' }}
                                        </div>
                                        <div style="font-size: 12px; color: #64748b;">{{ $user->name }}</div>
                                        <div style="font-size: 11px; color: #94a3b8;">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td style="padding: 15px 10px;">
                                <span
                                    style="background: #f1f5f9; color: #334155; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                    {{ str_replace('_', ' ', $user->role) }}
                                </span>
                            </td>

                            <td style="padding: 15px 10px; color: #475569; font-size: 13px;">
                                <div>{{ $user->fakultas ?? '-' }}</div>
                                <div style="font-size: 11px; color: #94a3b8;">{{ $user->program_studi ?? '-' }}</div>
                            </td>

                            <td style="padding: 15px 10px;">
                                @if ($user->status === 'aktif')
                                    <span
                                        style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700;">AKTIF</span>
                                @else
                                    <span
                                        style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700;">NONAKTIF</span>
                                @endif
                            </td>

                            <!-- Tombol Aksi Lengkap (Detail, Edit, Toggle Status) -->
                            <td style="padding: 15px 10px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 6px; align-items: center;">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('admin.biro.pengguna.show', $user->id) }}"
                                        style="background: #e2e8f0; color: #334155; text-decoration: none; padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                        Detail
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.biro.pengguna.edit', $user->id) }}"
                                        style="background: #e0f2fe; color: #0369a1; text-decoration: none; padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                        Edit
                                    </a>

                                    <!-- Tombol Suspend / Aktifkan -->
                                    <form action="{{ route('admin.biro.pengguna.status', $user->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        @if ($user->status === 'aktif')
                                            <button type="submit" onclick="return confirm('Nonaktifkan akun ini?')"
                                                style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                                Non-Aktifkan
                                            </button>
                                        @else
                                            <button type="submit" onclick="return confirm('Aktifkan kembali akun ini?')"
                                                style="background: #dcfce7; color: #166534; border: none; padding: 6px 10px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: #94a3b8;">Tidak ada data
                                pengguna yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
