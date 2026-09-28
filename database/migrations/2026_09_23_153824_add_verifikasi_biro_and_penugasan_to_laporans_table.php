<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {

            // =========================
            // VERIFIKASI ADMIN BIRO
            // =========================

            $table->string('prioritas')
                ->nullable()
                ->after('catatan_verifikasi');

            $table->text('catatan_verifikasi_biro')
                ->nullable()
                ->after('prioritas');

            $table->timestamp('diverifikasi_biro_at')
                ->nullable()
                ->after('catatan_verifikasi_biro');


            // =========================
            // PENUGASAN TEKNISI
            // =========================

            $table->foreignId('teknisi_id')
                ->nullable()
                ->after('diverifikasi_biro_at')
                ->constrained('users')
                ->nullOnDelete();

            $table->date('tanggal_penugasan')
                ->nullable()
                ->after('teknisi_id');

            $table->date('target_selesai')
                ->nullable()
                ->after('tanggal_penugasan');

            $table->text('instruksi_teknisi')
                ->nullable()
                ->after('target_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {

            $table->dropForeign([
                'teknisi_id'
            ]);

            $table->dropColumn([
                'prioritas',
                'catatan_verifikasi_biro',
                'diverifikasi_biro_at',
                'teknisi_id',
                'tanggal_penugasan',
                'target_selesai',
                'instruksi_teknisi',
            ]);
        });
    }
};