<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (Menambah kolom)
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambah kolom 'status' setelah kolom 'role' dengan nilai bawaan 'aktif'
            $table->string('status')->default('aktif')->after('role');
        });
    }

    /**
     * Kembalikan migration (Menghapus kolom jika di-rollback)
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};