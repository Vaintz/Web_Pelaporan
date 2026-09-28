<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('nomor_laporan')
                ->unique()
                ->nullable()
                ->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropUnique(['nomor_laporan']);
            $table->dropColumn('nomor_laporan');
        });
    }
};