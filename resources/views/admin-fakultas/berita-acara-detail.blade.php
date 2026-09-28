@extends('layouts.dashboard')

@section('title', 'Berita Acara Laporan')

@section('content')

<style>
    .ba-page {
        padding: 10px 4px 40px;
    }

    .ba-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 22px;
        gap: 20px;
    }

    .ba-header-left {
        flex: 1;
    }

    .ba-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #25243a;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .ba-breadcrumb span {
        font-size: 20px;
    }

    .ba-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #25243a;
    }

    .ba-subtitle {
        margin: 5px 0 12px;
        font-size: 13px;
        color: #9295a5;
    }

    .ba-number-row {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ba-number {
        font-size: 19px;
        font-weight: 700;
        color: #25243a;
    }

    .status-valid {
        display: inline-flex;
        align-items: center;
        padding: 6px 17px;
        border-radius: 8px;
        background: #e5f8e9;
        border: 1px solid #42a85f;
        color: #18752e;
        font-size: 13px;
        font-weight: 700;
    }

    .ba-actions {
        display: flex;
        gap: 9px;
        padding-top: 30px;
    }

    .ba-btn {
        height: 38px;
        padding: 0 13px;
        border-radius: 9px;
        border: 1px solid #25243a;
        background: white;
        color: #25243a;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        cursor: pointer;
        text-decoration: none;
    }

    .ba-btn-primary {
        background: #25243a;
        color: white;
    }

    .ba-layout {
        display: grid;
        grid-template-columns: minmax(500px, 1fr) minmax(500px, 1fr);
        gap: 20px;
        align-items: start;
    }

    .ba-left {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .ba-card {
        background: #fff;
        border: 1px solid #dedee5;
        border-radius: 11px;
        padding: 17px 26px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, .12);
    }

    .ba-card-title {
        margin: 0 0 12px;
        font-size: 14px;
        font-weight: 800;
        color: #25243a;
    }

    .ba-info {
        display: grid;
        grid-template-columns: 135px 15px 1fr;
        row-gap: 9px;
        font-size: 12px;
        line-height: 1.4;
    }

    .ba-info .label {
        font-weight: 700;
        color: #25243a;
    }

    .ba-info .colon {
        text-align: center;
        font-weight: 700;
    }

    .ba-info .value {
        font-weight: 600;
        color: #25243a;
    }

    .ba-description {
        line-height: 1.5;
    }

    .attachment-grid {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .attachment {
        position: relative;
        width: 120px;
        height: 80px;
        border: 2px solid #25243a;
        border-radius: 9px;
        overflow: hidden;
        cursor: pointer;
        background: #f5f5f5;
    }

    .attachment img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .attachment-icon {
        position: absolute;
        right: 4px;
        bottom: 4px;
        width: 17px;
        height: 17px;
        background: #25243a;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
    }

    .result-valid {
        display: inline-block;
        padding: 5px 13px;
        border-radius: 7px;
        background: #e5f8e9;
        color: #25803a;
        font-weight: 700;
        font-size: 12px;
    }

    .ba-document-area {
        position: sticky;
        top: 20px;
    }

    .ba-document {
        width: 100%;
        min-height: 755px;
        background: white;
        border: 1px solid #333;
        padding: 27px 58px;
        color: #111;
        font-family: "Times New Roman", serif;
        font-size: 10px;
        line-height: 1.45;
    }

    .doc-header {
        display: flex;
        align-items: center;
        border-bottom: 2px solid #111;
        padding-bottom: 7px;
        margin-bottom: 20px;
    }

    .doc-logo {
        width: 58px;
        height: 58px;
        object-fit: contain;
        margin-right: 13px;
    }

    .doc-header-text {
        flex: 1;
        text-align: center;
        line-height: 1.25;
    }

    .doc-header-text strong {
        font-size: 11px;
    }

    .doc-header-text .university {
        font-size: 13px;
        font-weight: bold;
    }

    .doc-title {
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        margin-top: 17px;
        margin-bottom: 5px;
    }

    .doc-number {
        text-align: center;
        margin-bottom: 25px;
    }

    .doc-paragraph {
        margin: 0 0 13px;
        text-align: justify;
    }

    .doc-table {
        width: 100%;
        border-collapse: collapse;
        margin: 7px 0 15px;
    }

    .doc-table td {
        padding: 1px 0;
        vertical-align: top;
    }

    .doc-table td:first-child {
        width: 145px;
    }

    .doc-signature {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 30px;
        gap: 60px;
        text-align: center;
    }

    .signature-space {
        height: 58px;
    }

    .signature-name {
        font-weight: bold;
    }

    .doc-footer {
        margin-top: 20px;
    }

    .print-note {
        margin-top: 10px;
        padding: 13px 18px;
        border: 1px solid #6687ff;
        border-radius: 9px;
        background: #f0f4ff;
        color: #9196a7;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .print-note-icon {
        width: 25px;
        height: 25px;
        border: 2px solid #315cff;
        border-radius: 50%;
        color: #315cff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    @media (max-width: 1100px) {
        .ba-layout {
            grid-template-columns: 1fr;
        }

        .ba-document-area {
            position: static;
        }

        .ba-header {
            flex-direction: column;
        }

        .ba-actions {
            padding-top: 0;
        }
    }

    @media print {
        body * {
            visibility: hidden !important;
        }

        .ba-document,
        .ba-document * {
            visibility: visible !important;
        }

        .ba-document {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            min-height: auto;
            border: none;
            box-shadow: none;
        }

        @page {
            size: A4;
            margin: 15mm;
        }
    }
</style>

<div class="ba-page">

    {{-- =========================
        HEADER
    ========================== --}}
    <div class="ba-header">

        <div class="ba-header-left">

            <div class="ba-breadcrumb" onclick="history.back()">
                <span>←</span>
                Berita Acara / Detail Berita Acara
            </div>

            <h1 class="ba-title">Berita Acara Laporan</h1>

            <p class="ba-subtitle">
                Berikut adalah berita acara dari laporan yang telah diverifikasi dan diteruskan.
            </p>

            <div class="ba-number-row">
                <div class="ba-number">
                    {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}
                </div>

                <div class="status-valid">
                    Telah Diverifikasi
                </div>
            </div>

        </div>

        <div class="ba-actions">

            <button type="button"
                    class="ba-btn"
                    onclick="history.back()">
                ← &nbsp; Kembali
            </button>

            <button type="button"
                    class="ba-btn"
                    onclick="window.print()">
                ◉ &nbsp; Preview
            </button>

            <button type="button"
                    class="ba-btn ba-btn-primary"
                    onclick="window.print()">
                ▣ &nbsp; Cetak Berita Acara
            </button>

        </div>

    </div>


    {{-- =========================
        MAIN CONTENT
    ========================== --}}
    <div class="ba-layout">

        {{-- =========================
            LEFT
        ========================== --}}
        <div class="ba-left">

            {{-- INFORMASI BERITA ACARA --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI BERITA ACARA
                </h3>

                <div class="ba-info">

                    <div class="label">Nomor Berita Acara</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->nomor_berita_acara ?? 'BA/FT/2026/0012' }}
                    </div>

                    <div class="label">Tanggal Dibuat</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>

                    <div class="label">Nomor Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}
                    </div>

                    <div class="label">Judul Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->judul ?? 'Kerusakan AC di Ruang Kelas 204' }}
                    </div>

                    <div class="label">Kategori Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->kategori->nama ?? 'Fasilitas' }}
                    </div>

                </div>

            </div>


            {{-- INFORMASI PELAPOR --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI PELAPOR
                </h3>

                <div class="ba-info">

                    <div class="label">Nama</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->name ?? $laporan->user->name ?? 'Budi Setiawan' }}
                    </div>

                    <div class="label">NIM/NIP</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->nim_nip ?? $laporan->user->nim_nip ?? '22018077' }}
                    </div>

                    <div class="label">Fakultas</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->fakultas ?? 'Fakultas Teknik' }}
                    </div>

                    <div class="label">Unit</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->unit ?? 'Prodi Sistem Informasi' }}
                    </div>

                </div>

            </div>


            {{-- URAIAN LAPORAN --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    URAIAN LAPORAN
                </h3>

                <div class="ba-info">

                    <div class="label">Tanggal Kejadian</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_kejadian)->format('d F Y') ?? '27 Agustus 2026' }}
                    </div>

                    <div class="label">Lokasi Kejadian</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->lokasi ?? 'Gedung A Lantai 2 Ruang Kelas 204' }}
                    </div>

                    <div class="label">Kronologi / Deskripsi</div>
                    <div class="colon">:</div>
                    <div class="value ba-description">
                        {{ $laporan->deskripsi ?? 'AC tidak dingin dan mengeluarkan suara berisik saat dinyalakan.' }}
                    </div>

                </div>

            </div>


            {{-- BUKTI --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    BUKTI / LAMPIRAN
                </h3>

                <div class="attachment-grid">

                    @if(isset($laporan->lampiran) && count($laporan->lampiran))

                        @foreach($laporan->lampiran as $file)

                            <div class="attachment"
                                 onclick="window.open('{{ asset('storage/' . $file->path) }}', '_blank')">

                                <img src="{{ asset('storage/' . $file->path) }}"
                                     alt="Lampiran">

                                <div class="attachment-icon">
                                    ⌕
                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="attachment">
                            <img src="{{ asset('images/no-image.png') }}"
                                 alt="Tidak ada lampiran">

                            <div class="attachment-icon">
                                ⌕
                            </div>
                        </div>

                    @endif

                </div>

            </div>


            {{-- HASIL VERIFIKASI --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    HASIL VERIFIKASI
                </h3>

                <div class="ba-info">

                    <div class="label">Valid</div>
                    <div class="colon">:</div>
                    <div class="value">
                        <span class="result-valid">
                            Valid
                        </span>
                    </div>

                    <div class="label">Catatan Admin Fakultas</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->catatan_verifikasi ?? 'Kerusakan sesuai laporan. Mohon ditindaklanjuti.' }}
                    </div>

                </div>

            </div>


            {{-- INFORMASI PENERUSAN --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI PENERUSAN
                </h3>

                <div class="ba-info">

                    <div class="label">Diteruskan Kepada</div>
                    <div class="colon">:</div>
                    <div class="value">
                        Biro Umum dan Keuangan
                    </div>

                    <div class="label">Tanggal Penerusan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_penerusan)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>

                    <div class="label">Admin yang meneruskan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ auth()->user()->name ?? 'Admin Fakultas' }}
                    </div>

                    <div class="label">Catatan Penerusan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->catatan_penerusan ?? 'Mohon untuk ditindaklanjuti sesuai SOP.' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            RIGHT - DOKUMEN
        ========================== --}}
        <div class="ba-document-area">

            <div class="ba-document">

                {{-- KOP --}}
                <div class="doc-header">

                    {{-- Kalau sudah punya logo, ganti path ini --}}
                    <img src="{{ asset('images/logo-unimal.png') }}"
                         class="doc-logo"
                         alt="Logo">

                    <div class="doc-header-text">

                        <div>
                            KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br>
                            DAN TEKNOLOGI
                        </div>

                        <div class="university">
                            UNIVERSITAS MALIKUSSALEH
                        </div>

                        <div>
                            Jl. Cot Teungku Nie, Reuleut Kecamatan Muara Batu - Aceh Utara<br>
                            Laman: http://www.unimal.ac.id
                        </div>

                    </div>

                </div>


                <div class="doc-title">
                    BERITA ACARA VERIFIKASI LAPORAN
                </div>

                <div class="doc-number">
                    Nomor: {{ $laporan->nomor_berita_acara ?? 'BA/FT/2026/0012' }}
                </div>


                <p class="doc-paragraph">
                    Pada hari ini, kami tanggal
                    <strong>
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? 'Dua Puluh Delapan Agustus Tahun Dua Ribu Dua Puluh Enam' }}
                    </strong>,
                    kami yang bertanda tangan di bawah ini:
                </p>


                <table class="doc-table">

                    <tr>
                        <td>Nama</td>
                        <td>: {{ auth()->user()->name ?? 'Admin Fakultas' }}</td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>: Admin Fakultas</td>
                    </tr>

                    <tr>
                        <td>Bertindak atas nama</td>
                        <td>: Fakultas {{ $laporan->pelapor->fakultas ?? 'Teknik' }}</td>
                    </tr>

                </table>


                <p class="doc-paragraph">
                    Dengan ini menerangkan bahwa telah dilakukan verifikasi terhadap
                    laporan sebagai berikut:
                </p>


                <table class="doc-table">

                    <tr>
                        <td>Nomor Laporan</td>
                        <td>: {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}</td>
                    </tr>

                    <tr>
                        <td>Judul Laporan</td>
                        <td>: {{ $laporan->judul ?? 'Kerusakan AC Ruang Kelas 204' }}</td>
                    </tr>

                    <tr>
                        <td>Kategori Laporan</td>
                        <td>: {{ $laporan->kategori->nama ?? 'Fasilitas' }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Kejadian</td>
                        <td>: {{ optional($laporan->tanggal_kejadian)->format('d F Y') ?? '27 Agustus 2026' }}</td>
                    </tr>

                    <tr>
                        <td>Lokasi Kejadian</td>
                        <td>: {{ $laporan->lokasi ?? 'Gedung A, Lantai 2, Ruang 204' }}</td>
                    </tr>

                    <tr>
                        <td>Pelapor</td>
                        <td>: {{ $laporan->pelapor->name ?? $laporan->user->name ?? 'Budi Setiawan' }}</td>
                    </tr>

                </table>


                <p class="doc-paragraph">
                    Berdasarkan hasil verifikasi, laporan tersebut dinyatakan
                    <strong>VALID</strong> dan akan diteruskan kepada
                    <strong>Biro Umum dan Keuangan</strong> untuk proses penanganan
                    lebih lanjut.
                </p>


                <p class="doc-paragraph">
                    Demikian berita acara ini dibuat dengan sebenar-benarnya untuk
                    dapat dipergunakan sebagaimana mestinya.
                </p>


                <div class="doc-footer">

                    <div style="text-align:right;">
                        Lhokseumawe,
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>


                    <div class="doc-signature">

                        <div>
                            Mengetahui,<br>
                            Dekan Fakultas
                            <div class="signature-space"></div>

                            <div class="signature-name">
                                __________________________
                            </div>

                            <div>
                                NIP.
                            </div>
                        </div>


                        <div>
                            Diverifikasi oleh,<br>
                            Admin Fakultas
                            <div class="signature-space"></div>

                            <div class="signature-name">
                                {{ auth()->user()->name ?? '__________________________' }}
                            </div>

                            <div>
                                NIP.
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="print-note">

                <div class="print-note-icon">
                    !
                </div>

                <div>
                    Pastikan semua data sudah benar sebelum mencetak
                    Berita Acara.
                </div>

            </div>

        </div>

    </div>

</div>

@endsection@extends('layouts.dashboard')

@section('title', 'Berita Acara Laporan')

@section('content')

<style>
    .ba-page {
        padding: 10px 4px 40px;
    }

    .ba-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 22px;
        gap: 20px;
    }

    .ba-header-left {
        flex: 1;
    }

    .ba-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #25243a;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .ba-breadcrumb span {
        font-size: 20px;
    }

    .ba-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #25243a;
    }

    .ba-subtitle {
        margin: 5px 0 12px;
        font-size: 13px;
        color: #9295a5;
    }

    .ba-number-row {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .ba-number {
        font-size: 19px;
        font-weight: 700;
        color: #25243a;
    }

    .status-valid {
        display: inline-flex;
        align-items: center;
        padding: 6px 17px;
        border-radius: 8px;
        background: #e5f8e9;
        border: 1px solid #42a85f;
        color: #18752e;
        font-size: 13px;
        font-weight: 700;
    }

    .ba-actions {
        display: flex;
        gap: 9px;
        padding-top: 30px;
    }

    .ba-btn {
        height: 38px;
        padding: 0 13px;
        border-radius: 9px;
        border: 1px solid #25243a;
        background: white;
        color: #25243a;
        font-size: 13px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        cursor: pointer;
        text-decoration: none;
    }

    .ba-btn-primary {
        background: #25243a;
        color: white;
    }

    .ba-layout {
        display: grid;
        grid-template-columns: minmax(500px, 1fr) minmax(500px, 1fr);
        gap: 20px;
        align-items: start;
    }

    .ba-left {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .ba-card {
        background: #fff;
        border: 1px solid #dedee5;
        border-radius: 11px;
        padding: 17px 26px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, .12);
    }

    .ba-card-title {
        margin: 0 0 12px;
        font-size: 14px;
        font-weight: 800;
        color: #25243a;
    }

    .ba-info {
        display: grid;
        grid-template-columns: 135px 15px 1fr;
        row-gap: 9px;
        font-size: 12px;
        line-height: 1.4;
    }

    .ba-info .label {
        font-weight: 700;
        color: #25243a;
    }

    .ba-info .colon {
        text-align: center;
        font-weight: 700;
    }

    .ba-info .value {
        font-weight: 600;
        color: #25243a;
    }

    .ba-description {
        line-height: 1.5;
    }

    .attachment-grid {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .attachment {
        position: relative;
        width: 120px;
        height: 80px;
        border: 2px solid #25243a;
        border-radius: 9px;
        overflow: hidden;
        cursor: pointer;
        background: #f5f5f5;
    }

    .attachment img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .attachment-icon {
        position: absolute;
        right: 4px;
        bottom: 4px;
        width: 17px;
        height: 17px;
        background: #25243a;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
    }

    .result-valid {
        display: inline-block;
        padding: 5px 13px;
        border-radius: 7px;
        background: #e5f8e9;
        color: #25803a;
        font-weight: 700;
        font-size: 12px;
    }

    .ba-document-area {
        position: sticky;
        top: 20px;
    }

    .ba-document {
        width: 100%;
        min-height: 755px;
        background: white;
        border: 1px solid #333;
        padding: 27px 58px;
        color: #111;
        font-family: "Times New Roman", serif;
        font-size: 10px;
        line-height: 1.45;
    }

    .doc-header {
        display: flex;
        align-items: center;
        border-bottom: 2px solid #111;
        padding-bottom: 7px;
        margin-bottom: 20px;
    }

    .doc-logo {
        width: 58px;
        height: 58px;
        object-fit: contain;
        margin-right: 13px;
    }

    .doc-header-text {
        flex: 1;
        text-align: center;
        line-height: 1.25;
    }

    .doc-header-text strong {
        font-size: 11px;
    }

    .doc-header-text .university {
        font-size: 13px;
        font-weight: bold;
    }

    .doc-title {
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        margin-top: 17px;
        margin-bottom: 5px;
    }

    .doc-number {
        text-align: center;
        margin-bottom: 25px;
    }

    .doc-paragraph {
        margin: 0 0 13px;
        text-align: justify;
    }

    .doc-table {
        width: 100%;
        border-collapse: collapse;
        margin: 7px 0 15px;
    }

    .doc-table td {
        padding: 1px 0;
        vertical-align: top;
    }

    .doc-table td:first-child {
        width: 145px;
    }

    .doc-signature {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 30px;
        gap: 60px;
        text-align: center;
    }

    .signature-space {
        height: 58px;
    }

    .signature-name {
        font-weight: bold;
    }

    .doc-footer {
        margin-top: 20px;
    }

    .print-note {
        margin-top: 10px;
        padding: 13px 18px;
        border: 1px solid #6687ff;
        border-radius: 9px;
        background: #f0f4ff;
        color: #9196a7;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .print-note-icon {
        width: 25px;
        height: 25px;
        border: 2px solid #315cff;
        border-radius: 50%;
        color: #315cff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    @media (max-width: 1100px) {
        .ba-layout {
            grid-template-columns: 1fr;
        }

        .ba-document-area {
            position: static;
        }

        .ba-header {
            flex-direction: column;
        }

        .ba-actions {
            padding-top: 0;
        }
    }

    @media print {
        body * {
            visibility: hidden !important;
        }

        .ba-document,
        .ba-document * {
            visibility: visible !important;
        }

        .ba-document {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            min-height: auto;
            border: none;
            box-shadow: none;
        }

        @page {
            size: A4;
            margin: 15mm;
        }
    }
</style>

<div class="ba-page">

    {{-- =========================
        HEADER
    ========================== --}}
    <div class="ba-header">

        <div class="ba-header-left">

            <div class="ba-breadcrumb" onclick="history.back()">
                <span>←</span>
                Berita Acara / Detail Berita Acara
            </div>

            <h1 class="ba-title">Berita Acara Laporan</h1>

            <p class="ba-subtitle">
                Berikut adalah berita acara dari laporan yang telah diverifikasi dan diteruskan.
            </p>

            <div class="ba-number-row">
                <div class="ba-number">
                    {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}
                </div>

                <div class="status-valid">
                    Telah Diverifikasi
                </div>
            </div>

        </div>

        <div class="ba-actions">

            <button type="button"
                    class="ba-btn"
                    onclick="history.back()">
                ← &nbsp; Kembali
            </button>

            <button type="button"
                    class="ba-btn"
                    onclick="window.print()">
                ◉ &nbsp; Preview
            </button>

            <button type="button"
                    class="ba-btn ba-btn-primary"
                    onclick="window.print()">
                ▣ &nbsp; Cetak Berita Acara
            </button>

        </div>

    </div>


    {{-- =========================
        MAIN CONTENT
    ========================== --}}
    <div class="ba-layout">

        {{-- =========================
            LEFT
        ========================== --}}
        <div class="ba-left">

            {{-- INFORMASI BERITA ACARA --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI BERITA ACARA
                </h3>

                <div class="ba-info">

                    <div class="label">Nomor Berita Acara</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->nomor_berita_acara ?? 'BA/FT/2026/0012' }}
                    </div>

                    <div class="label">Tanggal Dibuat</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>

                    <div class="label">Nomor Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}
                    </div>

                    <div class="label">Judul Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->judul ?? 'Kerusakan AC di Ruang Kelas 204' }}
                    </div>

                    <div class="label">Kategori Laporan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->kategori->nama ?? 'Fasilitas' }}
                    </div>

                </div>

            </div>


            {{-- INFORMASI PELAPOR --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI PELAPOR
                </h3>

                <div class="ba-info">

                    <div class="label">Nama</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->name ?? $laporan->user->name ?? 'Budi Setiawan' }}
                    </div>

                    <div class="label">NIM/NIP</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->nim_nip ?? $laporan->user->nim_nip ?? '22018077' }}
                    </div>

                    <div class="label">Fakultas</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->fakultas ?? 'Fakultas Teknik' }}
                    </div>

                    <div class="label">Unit</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->pelapor->unit ?? 'Prodi Sistem Informasi' }}
                    </div>

                </div>

            </div>


            {{-- URAIAN LAPORAN --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    URAIAN LAPORAN
                </h3>

                <div class="ba-info">

                    <div class="label">Tanggal Kejadian</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_kejadian)->format('d F Y') ?? '27 Agustus 2026' }}
                    </div>

                    <div class="label">Lokasi Kejadian</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->lokasi ?? 'Gedung A Lantai 2 Ruang Kelas 204' }}
                    </div>

                    <div class="label">Kronologi / Deskripsi</div>
                    <div class="colon">:</div>
                    <div class="value ba-description">
                        {{ $laporan->deskripsi ?? 'AC tidak dingin dan mengeluarkan suara berisik saat dinyalakan.' }}
                    </div>

                </div>

            </div>


            {{-- BUKTI --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    BUKTI / LAMPIRAN
                </h3>

                <div class="attachment-grid">

                    @if(isset($laporan->lampiran) && count($laporan->lampiran))

                        @foreach($laporan->lampiran as $file)

                            <div class="attachment"
                                 onclick="window.open('{{ asset('storage/' . $file->path) }}', '_blank')">

                                <img src="{{ asset('storage/' . $file->path) }}"
                                     alt="Lampiran">

                                <div class="attachment-icon">
                                    ⌕
                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="attachment">
                            <img src="{{ asset('images/no-image.png') }}"
                                 alt="Tidak ada lampiran">

                            <div class="attachment-icon">
                                ⌕
                            </div>
                        </div>

                    @endif

                </div>

            </div>


            {{-- HASIL VERIFIKASI --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    HASIL VERIFIKASI
                </h3>

                <div class="ba-info">

                    <div class="label">Valid</div>
                    <div class="colon">:</div>
                    <div class="value">
                        <span class="result-valid">
                            Valid
                        </span>
                    </div>

                    <div class="label">Catatan Admin Fakultas</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->catatan_verifikasi ?? 'Kerusakan sesuai laporan. Mohon ditindaklanjuti.' }}
                    </div>

                </div>

            </div>


            {{-- INFORMASI PENERUSAN --}}
            <div class="ba-card">

                <h3 class="ba-card-title">
                    INFORMASI PENERUSAN
                </h3>

                <div class="ba-info">

                    <div class="label">Diteruskan Kepada</div>
                    <div class="colon">:</div>
                    <div class="value">
                        Biro Umum dan Keuangan
                    </div>

                    <div class="label">Tanggal Penerusan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ optional($laporan->tanggal_penerusan)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>

                    <div class="label">Admin yang meneruskan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ auth()->user()->name ?? 'Admin Fakultas' }}
                    </div>

                    <div class="label">Catatan Penerusan</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ $laporan->catatan_penerusan ?? 'Mohon untuk ditindaklanjuti sesuai SOP.' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            RIGHT - DOKUMEN
        ========================== --}}
        <div class="ba-document-area">

            <div class="ba-document">

                {{-- KOP --}}
                <div class="doc-header">

                    {{-- Kalau sudah punya logo, ganti path ini --}}
                    <img src="{{ asset('images/logo-unimal.png') }}"
                         class="doc-logo"
                         alt="Logo">

                    <div class="doc-header-text">

                        <div>
                            KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br>
                            DAN TEKNOLOGI
                        </div>

                        <div class="university">
                            UNIVERSITAS MALIKUSSALEH
                        </div>

                        <div>
                            Jl. Cot Teungku Nie, Reuleut Kecamatan Muara Batu - Aceh Utara<br>
                            Laman: http://www.unimal.ac.id
                        </div>

                    </div>

                </div>


                <div class="doc-title">
                    BERITA ACARA VERIFIKASI LAPORAN
                </div>

                <div class="doc-number">
                    Nomor: {{ $laporan->nomor_berita_acara ?? 'BA/FT/2026/0012' }}
                </div>


                <p class="doc-paragraph">
                    Pada hari ini, kami tanggal
                    <strong>
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? 'Dua Puluh Delapan Agustus Tahun Dua Ribu Dua Puluh Enam' }}
                    </strong>,
                    kami yang bertanda tangan di bawah ini:
                </p>


                <table class="doc-table">

                    <tr>
                        <td>Nama</td>
                        <td>: {{ auth()->user()->name ?? 'Admin Fakultas' }}</td>
                    </tr>

                    <tr>
                        <td>Jabatan</td>
                        <td>: Admin Fakultas</td>
                    </tr>

                    <tr>
                        <td>Bertindak atas nama</td>
                        <td>: Fakultas {{ $laporan->pelapor->fakultas ?? 'Teknik' }}</td>
                    </tr>

                </table>


                <p class="doc-paragraph">
                    Dengan ini menerangkan bahwa telah dilakukan verifikasi terhadap
                    laporan sebagai berikut:
                </p>


                <table class="doc-table">

                    <tr>
                        <td>Nomor Laporan</td>
                        <td>: {{ $laporan->nomor_laporan ?? 'LP-2026-0012' }}</td>
                    </tr>

                    <tr>
                        <td>Judul Laporan</td>
                        <td>: {{ $laporan->judul ?? 'Kerusakan AC Ruang Kelas 204' }}</td>
                    </tr>

                    <tr>
                        <td>Kategori Laporan</td>
                        <td>: {{ $laporan->kategori->nama ?? 'Fasilitas' }}</td>
                    </tr>

                    <tr>
                        <td>Tanggal Kejadian</td>
                        <td>: {{ optional($laporan->tanggal_kejadian)->format('d F Y') ?? '27 Agustus 2026' }}</td>
                    </tr>

                    <tr>
                        <td>Lokasi Kejadian</td>
                        <td>: {{ $laporan->lokasi ?? 'Gedung A, Lantai 2, Ruang 204' }}</td>
                    </tr>

                    <tr>
                        <td>Pelapor</td>
                        <td>: {{ $laporan->pelapor->name ?? $laporan->user->name ?? 'Budi Setiawan' }}</td>
                    </tr>

                </table>


                <p class="doc-paragraph">
                    Berdasarkan hasil verifikasi, laporan tersebut dinyatakan
                    <strong>VALID</strong> dan akan diteruskan kepada
                    <strong>Biro Umum dan Keuangan</strong> untuk proses penanganan
                    lebih lanjut.
                </p>


                <p class="doc-paragraph">
                    Demikian berita acara ini dibuat dengan sebenar-benarnya untuk
                    dapat dipergunakan sebagaimana mestinya.
                </p>


                <div class="doc-footer">

                    <div style="text-align:right;">
                        Lhokseumawe,
                        {{ optional($laporan->tanggal_berita_acara)->format('d F Y') ?? '28 Agustus 2026' }}
                    </div>


                    <div class="doc-signature">

                        <div>
                            Mengetahui,<br>
                            Dekan Fakultas
                            <div class="signature-space"></div>

                            <div class="signature-name">
                                __________________________
                            </div>

                            <div>
                                NIP.
                            </div>
                        </div>


                        <div>
                            Diverifikasi oleh,<br>
                            Admin Fakultas
                            <div class="signature-space"></div>

                            <div class="signature-name">
                                {{ auth()->user()->name ?? '__________________________' }}
                            </div>

                            <div>
                                NIP.
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="print-note">

                <div class="print-note-icon">
                    !
                </div>

                <div>
                    Pastikan semua data sudah benar sebelum mencetak
                    Berita Acara.
                </div>

            </div>

        </div>

    </div>

</div>

@endsection