<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('ruangan', 255)->nullable()->after('gedung_id');
        });

        // Pindahkan nama ruangan lama ke kolom teks sebelum relasi lama dihapus.
        DB::statement("
            UPDATE laporans l
            LEFT JOIN ruangans r ON r.id = l.ruangan_id
            SET l.ruangan = r.nama
            WHERE l.ruangan_id IS NOT NULL
        ");

        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['ruangan_id']);
            $table->dropColumn('ruangan_id');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreignId('ruangan_id')
                ->nullable()
                ->after('gedung_id')
                ->constrained('ruangans')
                ->nullOnDelete();
        });

        DB::statement("
            UPDATE laporans
            SET ruangan_id = (
                SELECT r.id
                FROM ruangans r
                WHERE r.nama = laporans.ruangan
                LIMIT 1
            )
            WHERE ruangan IS NOT NULL
        ");

        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('ruangan');
        });
    }
};
