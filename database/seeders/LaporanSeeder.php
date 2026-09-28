<?php

namespace Database\Seeders;

use App\Models\Gedung;
use App\Models\KategoriKerusakan;
use App\Models\Laporan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LaporanSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER PELAPOR
        |--------------------------------------------------------------------------
        */

        $user = User::where('role', 'pelapor')->first();

        if (!$user) {
            $user = User::first();
        }

        if (!$user) {
            $this->command->error(
                'Belum ada user. Jalankan UserSeeder terlebih dahulu.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | KATEGORI
        |--------------------------------------------------------------------------
        */

        $kategori = KategoriKerusakan::orderBy('id')->get();

        if ($kategori->isEmpty()) {
            $this->command->error(
                'Belum ada data kategori kerusakan.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | GEDUNG
        |--------------------------------------------------------------------------
        */

        $gedung = Gedung::orderBy('id')->first();

        if (!$gedung) {
            $this->command->error(
                'Belum ada data gedung.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | RUANGAN
        |--------------------------------------------------------------------------
        */

        $ruangan = Ruangan::where(
            'gedung_id',
            $gedung->id
        )
            ->orderBy('id')
            ->first();

        if (!$ruangan) {
            $this->command->error(
                'Belum ada data ruangan untuk gedung tersebut.'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA LAPORAN USER
        |--------------------------------------------------------------------------
        */

        Laporan::where(
            'user_id',
            $user->id
        )->delete();


        /*
        |--------------------------------------------------------------------------
        | DATA LAPORAN
        |--------------------------------------------------------------------------
        */

        $laporans = [

            [
                'judul_laporan' =>
                    'Kerusakan AC Ruang 201',

                'deskripsi_kerusakan' =>
                    'AC tidak mengeluarkan udara dingin dan terdengar suara cukup berisik saat dinyalakan.',

                'detail_lokasi' =>
                    'AC bagian depan Ruang 201.',

                'status' =>
                    'diproses',

                'tanggal' =>
                    '2026-09-08 08:30:00',

                'kategori_index' =>
                    0,
            ],


            [
                'judul_laporan' =>
                    'Lampu Ruang Kuliah Mati',

                'deskripsi_kerusakan' =>
                    'Lampu utama di dalam ruang kuliah tidak dapat menyala.',

                'detail_lokasi' =>
                    'Lampu bagian tengah ruang kuliah.',

                'status' =>
                    'selesai',

                'tanggal' =>
                    '2026-09-09 09:15:00',

                'kategori_index' =>
                    1,
            ],


            [
                'judul_laporan' =>
                    'Gangguan Jaringan Lab',

                'deskripsi_kerusakan' =>
                    'Jaringan internet pada beberapa komputer laboratorium tidak dapat digunakan.',

                'detail_lokasi' =>
                    'Laboratorium komputer bagian belakang.',

                'status' =>
                    'menunggu_verifikasi',

                'tanggal' =>
                    '2026-09-10 10:00:00',

                'kategori_index' =>
                    2,
            ],


            [
                'judul_laporan' =>
                    'Kendala Sistem Akademik',

                'deskripsi_kerusakan' =>
                    'Sistem akademik mengalami kendala ketika digunakan untuk melakukan proses pengisian data.',

                'detail_lokasi' =>
                    'Ruang administrasi fakultas.',

                'status' =>
                    'ditolak',

                'tanggal' =>
                    '2026-09-10 11:20:00',

                'kategori_index' =>
                    2,
            ],


            [
                'judul_laporan' =>
                    'Infokus Kelas 3.2 Rusak',

                'deskripsi_kerusakan' =>
                    'Infokus tidak dapat menampilkan gambar dari perangkat laptop.',

                'detail_lokasi' =>
                    'Ruang Kelas 3.2.',

                'status' =>
                    'selesai',

                'tanggal' =>
                    '2026-09-11 13:00:00',

                'kategori_index' =>
                    0,
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | INSERT LAPORAN
        |--------------------------------------------------------------------------
        */

        foreach ($laporans as $data) {

            /*
            |--------------------------------------------------------------------------
            | Tentukan kategori
            |--------------------------------------------------------------------------
            */

            $kategoriIndex =
                $data['kategori_index'];

            if (!isset($kategori[$kategoriIndex])) {
                $kategoriIndex = 0;
            }


            /*
            |--------------------------------------------------------------------------
            | Tanggal laporan
            |--------------------------------------------------------------------------
            */

            $tanggal =
                Carbon::parse(
                    $data['tanggal']
                );


            /*
            |--------------------------------------------------------------------------
            | Buat laporan
            |--------------------------------------------------------------------------
            */

            $laporan = Laporan::create([

                'user_id' =>
                    $user->id,

                'kategori_kerusakan_id' =>
                    $kategori[$kategoriIndex]->id,

                'gedung_id' =>
                    $gedung->id,

                'ruangan_id' =>
                    $ruangan->id,

                'judul_laporan' =>
                    $data['judul_laporan'],

                'deskripsi_kerusakan' =>
                    $data['deskripsi_kerusakan'],

                'detail_lokasi' =>
                    $data['detail_lokasi'],

                'status' =>
                    $data['status'],

                'created_at' =>
                    $tanggal,

                'updated_at' =>
                    $tanggal,

            ]);


            /*
            |--------------------------------------------------------------------------
            | NOMOR LAPORAN
            |--------------------------------------------------------------------------
            |
            | Contoh:
            | LP-2026-0001
            | LP-2026-0002
            | LP-2026-0003
            |
            */

            $laporan->update([

                'nomor_laporan' =>
                    'LP-' .
                    $tanggal->format('Y') .
                    '-' .
                    str_pad(
                        $laporan->id,
                        4,
                        '0',
                        STR_PAD_LEFT
                    ),

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            '5 data laporan berhasil dibuat.'
        );
    }
}