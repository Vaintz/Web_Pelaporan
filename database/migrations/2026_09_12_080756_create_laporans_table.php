<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('kategori_kerusakan_id')
                ->constrained('kategori_kerusakans')
                ->restrictOnDelete();

            $table->foreignId('gedung_id')
                ->constrained('gedungs')
                ->restrictOnDelete();

            $table->foreignId('ruangan_id')
                ->constrained('ruangans')
                ->restrictOnDelete();

            $table->string('judul_laporan');
            $table->text('deskripsi_kerusakan');
            $table->text('detail_lokasi')->nullable();

            $table->string('status')->default('menunggu_verifikasi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};