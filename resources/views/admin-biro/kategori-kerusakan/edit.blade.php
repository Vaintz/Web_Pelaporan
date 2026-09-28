@extends('layouts.dashboard')

@section('title', 'Edit Kategori Kerusakan')

@section('content')
<div style="max-width: 600px; display: flex; flex-direction: column; gap: 20px;">
    <div style="background: white; padding: 35px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
        <h2 style="margin: 0 0 25px 0; color: #1a1a2e; font-size: 20px; font-weight: 700; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
            Edit Kategori Kerusakan
        </h2>

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 13px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.biro.kategori-kerusakan.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Kategori</label>
                <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" style="width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 14px; outline: none;" required>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 20px; display: flex; justify-content: flex-end; align-items: center; gap: 12px;">
                <a href="{{ route('admin.biro.kategori-kerusakan.index') }}" style="color: #64748b; text-decoration: none; font-size: 13px; font-weight: 600; padding: 10px 18px;">
                    Batal
                </a>
                <button type="submit" style="background: #212035; color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 13px;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection