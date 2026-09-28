@extends('layouts.dashboard')

@section('title', 'Laporan Masuk')

@section('content')

<style>
    .page-header {
        margin-bottom: 24px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .page-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* FILTER */
    .filter-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 20px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 1fr 220px auto;
        gap: 12px;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .form-control {
        height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 13px;
        font-size: 14px;
        outline: none;
        background: #fff;
        color: #374151;
    }

    .form-control:focus {
        border-color: #2563eb;
    }

    .btn-filter {
        height: 42px;
        border: none;
        border-radius: 8px;
        padding: 0 20px;
        background: #2563eb;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-filter:hover {
        background: #1d4ed8;
    }

    .btn-reset {
        height: 42px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 18px;
        background: #fff;
        color: #4b5563;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .filter-actions {
        display: flex;
        gap: 8px;
    }

    /* TABLE */
    .table-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .table-header span {
        font-size: 13px;
        color: #6b7280;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    thead {
        background: #f9fafb;
    }

    th {
        padding: 13px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    td {
        padding: 15px 16px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #fafafa;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .nomor-laporan {
        font-weight: 700;
        color: #2563eb;
        white-space: nowrap;
    }

    .judul-laporan {
        font-weight: 600;
        color: #1f2937;
        max-width: 240px;
    }

    .pelapor {
        white-space: nowrap;
    }

    .kategori {
        color: #4b5563;
    }

    .tanggal {
        white-space: nowrap;
        color: #6b7280;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fef3c7;
        color: #92400e;
    }

    /* DETAIL BUTTON */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        padding: 0 13px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-detail:hover {
        background: #dbeafe;
    }

    /* EMPTY */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }

    .empty-state-icon {
        width: 50px;
        height: 50px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .empty-state h4 {
        margin: 0 0 6px;
        font-size: 16px;
        color: #374151;
    }

    .empty-state p {
        margin: 0;
        font-size: 13px;
    }

    /* FOOTER */
    .table-footer {
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .pagination-info {
        font-size: 13px;
        color: #6b7280;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    .per-page {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #6b7280;
    }

    .per-page select {
        height: 34px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        padding: 0 8px;
        background: #fff;
        color: #374151;
        outline: none;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            width: 100%;
        }

        .btn-filter,
        .btn-reset {
            flex: 1;
        }

        .table-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .pagination-wrapper {
            width: 100%;
            justify-content: center;
        }
    }
</style>


{{-- FILTER --}}
<div class="filter-card">
    <form action="{{ route('admin.fakultas.laporan') }}" method="GET">
        <div class="filter-form">

            <div class="form-group">
                <label for="search">Cari Laporan</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    class="form-control"
                    placeholder="Cari nomor atau judul laporan..."
                    value="{{ request('search') }}"
                >
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="">Semua Kategori</option>

                    @foreach ($kategori as $item)
                        <option
                            value="{{ $item->id }}"
                            {{ request('kategori') == $item->id ? 'selected' : '' }}
                        >
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-filter">
                    Cari
                </button>

                <a
                    href="{{ route('admin.fakultas.laporan') }}"
                    class="btn-reset"
                >
                    Reset
                </a>
            </div>

        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="table-card">

    <div class="table-header">
        <div>
            <h3>Daftar Laporan</h3>
        </div>

        <span>
            {{ $laporans->total() }} laporan menunggu verifikasi
        </span>
    </div>

    <div class="table-wrapper">

        @if ($laporans->count() > 0)

            <table>
                <thead>
                    <tr>
                        <th>No. Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Pelapor</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($laporans as $laporan)

                        <tr>

                            <td>
                                <span class="nomor-laporan">
                                    {{ $laporan->nomor_laporan }}
                                </span>
                            </td>

                            <td>
                                <div class="judul-laporan">
                                    {{ $laporan->judul_laporan }}
                                </div>
                            </td>

                            <td>
                                <div class="pelapor">
                                    {{ $laporan->user->name ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="kategori">
                                    {{ $laporan->kategori->nama ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="tanggal">
                                    {{ $laporan->created_at->format('d/m/Y') }}
                                </span>
                            </td>

                            <td>
                                <span class="status-badge status-menunggu">
                                    Menunggu Verifikasi
                                </span>
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.fakultas.laporan.detail', $laporan->id) }}"
                                    class="btn-detail"
                                >
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>

        @else

            <div class="empty-state">

                <div class="empty-state-icon">
                    ✓
                </div>

                <h4>Tidak Ada Laporan Masuk</h4>

                <p>
                    Belum ada laporan yang menunggu proses verifikasi.
                </p>

            </div>

        @endif

    </div>

    {{-- FOOTER --}}
    @if ($laporans->count() > 0)

        <div class="table-footer">

            <div class="pagination-info">
                Menampilkan
                <strong>{{ $laporans->firstItem() }}</strong>
                -
                <strong>{{ $laporans->lastItem() }}</strong>
                dari
                <strong>{{ $laporans->total() }}</strong>
                laporan
            </div>

            <div class="pagination-wrapper">
                {{ $laporans->links() }}
            </div>

            <form
                action="{{ route('admin.fakultas.laporan') }}"
                method="GET"
                class="per-page"
            >

                @foreach (request()->except('per_page', 'page') as $key => $value)
                    <input
                        type="hidden"
                        name="{{ $key }}"
                        value="{{ $value }}"
                    >
                @endforeach

                <span>Data per halaman</span>

                <select
                    name="per_page"
                    onchange="this.form.submit()"
                >
                    <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>
                        5
                    </option>

                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>
                        10
                    </option>

                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>
                        50
                    </option>
                </select>

            </form>

        </div>

    @endif

</div>

@endsection