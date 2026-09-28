@extends('layouts.dashboard')

@section('title', 'Manajemen Ruangan')

@section('content')
<div style="max-width: 1050px; display: flex; flex-direction: column; gap: 20px;">
    
    <!-- HEADER -->
    <div style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="margin: 0 0 5px 0; color: #1a1a2e; font-size: 20px; font-weight: 700;">Manajemen Ruangan</h2>
            <p style="margin: 0; color: #64748b; font-size: 13px;">Kelola daftar ruangan, lokasi gedung, dan posisi lantai di lingkungan kampus.</p>
        </div>
        <a href="{{ route('admin.biro.ruangan.create') }}" style="background: #212035; color: white; text-decoration: none; padding: 10px 20px; border-radius: 12px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
            + Tambah Ruangan
        </a>
    </div>

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 12px; font-size: 14px; font-weight: 500;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- FILTER & SEARCH BAR -->
    <div style="background: white; padding: 20px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <form action="{{ route('admin.biro.ruangan.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
            
            <!-- Input Search Nama Ruangan -->
            <div style="flex: 1; min-width: 200px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama ruangan..." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none;">
            </div>

            <!-- Filter Gedung -->
            <div style="width: 200px;">
                <select name="gedung_id" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none; background: white;">
                    <option value="">Semua Gedung</option>
                    @foreach($listGedung as $gedung)
                        <option value="{{ $gedung->id }}" {{ request('gedung_id') == $gedung->id ? 'selected' : '' }}>
                            {{ $gedung->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Lantai -->
            <div style="width: 150px;">
                <input type="text" name="lantai" value="{{ request('lantai') }}" placeholder="Filter Lantai..." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none;">
            </div>

            <button type="submit" style="background: #334155; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;">
                Filter
            </button>

            @if(request('search') || request('gedung_id') || request('lantai'))
                <a href="{{ route('admin.biro.ruangan.index') }}" style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- TABEL DATA RUANGAN -->
    <div style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9; color: #64748b; font-size: 12px; text-transform: uppercase;">
                    <th style="padding: 12px 10px; width: 60px;">No</th>
                    <th style="padding: 12px 10px;">Nama Ruangan</th>
                    <th style="padding: 12px 10px;">Gedung</th>
                    <th style="padding: 12px 10px;">Lantai</th>
                    <th style="padding: 12px 10px; text-align: center; width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangans as $ruangan)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px 10px; color: #64748b; font-weight: 600;">{{ $loop->iteration }}</td>
                        <td style="padding: 15px 10px; font-weight: 600; color: #1e293b;">
                            {{ $ruangan->nama }}
                        </td>
                        <td style="padding: 15px 10px; color: #475569;">
                            {{ $ruangan->gedung->nama ?? '-' }}
                        </td>
                        <td style="padding: 15px 10px;">
                            <span style="background: #f1f5f9; color: #334155; padding: 4px 10px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                Lantai {{ $ruangan->lantai }}
                            </span>
                        </td>
                        <td style="padding: 15px 10px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 8px;">
                                <a href="{{ route('admin.biro.ruangan.edit', $ruangan->id) }}" style="background: #e0f2fe; color: #0369a1; text-decoration: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                    Edit
                                </a>
                                <form action="{{ route('admin.biro.ruangan.destroy', $ruangan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 30px; color: #94a3b8;">Data Ruangan belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection