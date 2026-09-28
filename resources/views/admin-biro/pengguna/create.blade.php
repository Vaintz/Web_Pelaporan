@extends('layouts.dashboard')

@section('title', 'Tambah Pengguna')

@section('content')
    <div style="max-width: 700px; display: flex; flex-direction: column; gap: 20px;">

        <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <h2
                style="margin: 0 0 25px 0; color: #1a1a2e; font-size: 20px; font-weight: 700; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
                Tambah Pengguna Baru
            </h2>

            <!-- Pesan Error Validasi -->
            @if ($errors->any())
                <div
                    style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.biro.pengguna.store') }}" method="POST">
                @csrf

                <div style="display: flex; flex-direction: column; gap: 16px;">

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;"
                            required>
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Email
                            Kampus</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="contoh: nama@mhs.unimal.ac.id atau nama@unimal.ac.id"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;"
                            required>
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Password
                            Awal</label>
                        <input type="password" name="password"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;"
                            required>
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Role
                            Pengguna</label>
                        <select name="role"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none; background: white;"
                            required>
                            <option value="pelapor">Pelapor (Mahasiswa/Dosen)</option>
                            <option value="admin_fakultas">Admin Fakultas</option>
                            <option value="admin_biro">Admin Biro</option>
                        </select>
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">NIM
                            / NIP / NIDN</label>
                        <input type="text" name="nim_nip" value="{{ old('nim_nip') }}"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;">
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Fakultas</label>
                        <!-- Nilai di-lock default 'Teknik' -->
                        <input type="text" name="fakultas" value="Teknik"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; background: #f8fafc; color: #64748b;"
                            readonly>
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Program
                            Studi</label>
                        <!-- Dropdown Prodi diambil langsung dari database tabel prodis -->
                        <select name="program_studi"
                            style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none; background: white;">
                            <option value="">-- Pilih Program Studi --</option>
                            @if(isset($listProdi))
                                @foreach($listProdi as $prodi)
                                    <option value="{{ $prodi->nama_prodi }}" {{ old('program_studi') == $prodi->nama_prodi ? 'selected' : '' }}>
                                        {{ $prodi->jenjang }} - {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                </div>

                <div
                    style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 20px; display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
                    <a href="{{ route('admin.biro.pengguna.index') }}"
                        style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px 18px;">
                        Batal
                    </a>
                    <button type="submit"
                        style="background: #212035; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 13px; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection