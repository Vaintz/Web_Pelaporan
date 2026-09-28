@extends('layouts.dashboard')

@section('title', 'Manajemen Teknisi')

@section('content')
    <div style="max-width: 1050px; display: flex; flex-direction: column; gap: 20px;">

        <div
            style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h2 style="margin: 0 0 5px 0; color: #1a1a2e; font-size: 20px; font-weight: 700;">Manajemen Teknisi</h2>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Kelola daftar teknisi yang akan menangani perbaikan
                    fasilitas kampus.</p>
            </div>
            <a href="{{ route('admin.biro.teknisi.create') }}"
                style="background: #212035; color: white; text-decoration: none; padding: 10px 20px; border-radius: 12px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(33,32,53,0.15);">
                + Tambah Teknisi
            </a>
        </div>

        @if (session('success'))
            <div
                style="background: #d4edda; color: #155724; padding: 12px 18px; border-radius: 12px; font-size: 14px; font-weight: 500;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div style="background: white; padding: 20px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
            <form action="{{ route('admin.biro.teknisi.index') }}" method="GET"
                style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
                <div style="flex: 1; min-width: 220px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama teknisi..."
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none;">
                </div>

                <div style="width: 180px;">
                    <select name="status"
                        style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; outline: none; background: white;">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak
                            Tersedia</option>
                    </select>
                </div>

                <button type="submit"
                    style="background: #334155; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;">
                    Filter
                </button>

                @if (request('search') || request('status'))
                    <a href="{{ route('admin.biro.teknisi.index') }}"
                        style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px;">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div
            style="background: white; padding: 25px 30px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr
                        style="border-bottom: 2px solid #f1f5f9; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 10px; width: 60px;">No</th>
                        <th style="padding: 12px 10px;">Nama Teknisi</th>
                        <th style="padding: 12px 10px;">Status</th>
                        <th style="padding: 12px 10px; text-align: center; width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teknisis as $teknisi)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 15px 10px; color: #64748b; font-weight: 600;">{{ $loop->iteration }}</td>
                            <td style="padding: 15px 10px; font-weight: 600; color: #1e293b;">
                                {{ $teknisi->nama }}
                            </td>
                            <td style="padding: 15px 10px;">
                                @if ($teknisi->status === 'tersedia')
                                    <span
                                        style="background: #d4edda; color: #155724; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700;">TERSEDIA</span>
                                @else
                                    <span
                                        style="background: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700;">TIDAK
                                        TERSEDIA</span>
                                @endif
                            </td>
                            <td style="padding: 15px 10px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    <a href="{{ route('admin.biro.teknisi.edit', $teknisi->id) }}"
                                        style="background: #e0f2fe; color: #0369a1; text-decoration: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.biro.teknisi.destroy', $teknisi->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus teknisi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background: #fee2e2; color: #991b1b; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">Data Teknisi belum
                                tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
