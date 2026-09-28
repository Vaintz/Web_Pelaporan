@extends('layouts.dashboard')

@section('title', 'Detail Pengguna')

@section('content')
<div style="max-width: 700px; display: flex; flex-direction: column; gap: 20px;">
    
    <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 20px;">
            <h2 style="margin: 0; color: #1a1a2e; font-size: 20px; font-weight: 700;">Detail Informasi Pengguna</h2>
            <a href="{{ route('admin.biro.pengguna.index') }}" style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600;">← Kembali</a>
        </div>

        <div style="display: flex; gap: 25px; align-items: center; margin-bottom: 25px;">
            <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; background: #eef2f3; display: flex; justify-content: center; align-items: center;">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <span style="color: #64748b; font-size: 16px; font-weight: 700;">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                @endif
            </div>
            <div>
                <h3 style="margin: 0 0 4px 0; color: #1e293b; font-size: 18px;">{{ $user->name }}</h3>
                <p style="margin: 0 0 8px 0; color: #64748b; font-size: 13px;">{{ $user->email }}</p>
                <span style="background: #f1f5f9; color: #334155; padding: 3px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                    {{ str_replace('_', ' ', $user->role) }}
                </span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; font-size: 14px;">
            <div style="background: #f8fafc; padding: 14px 18px; border-radius: 12px;">
                <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 2px;">NIM / NIP</span>
                <span style="color: #1e293b; font-weight: 600;">{{ $user->nim_nip ?? '-' }}</span>
            </div>
            <div style="background: #f8fafc; padding: 14px 18px; border-radius: 12px;">
                <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 2px;">No HP</span>
                <span style="color: #1e293b; font-weight: 600;">{{ $user->no_hp ?? '-' }}</span>
            </div>
            <div style="background: #f8fafc; padding: 14px 18px; border-radius: 12px;">
                <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 2px;">Fakultas</span>
                <span style="color: #1e293b; font-weight: 600;">{{ $user->fakultas ?? '-' }}</span>
            </div>
            <div style="background: #f8fafc; padding: 14px 18px; border-radius: 12px;">
                <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 2px;">Program Studi</span>
                <span style="color: #1e293b; font-weight: 600;">{{ $user->program_studi ?? '-' }}</span>
            </div>
            <div style="background: #f8fafc; padding: 14px 18px; border-radius: 12px; grid-column: span 2;">
                <span style="display: block; font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 2px;">Alamat</span>
                <span style="color: #1e293b; font-weight: 500;">{{ $user->alamat ?? '-' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection