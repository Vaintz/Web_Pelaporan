<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi'); // Contoh: Teknik Informatika, Teknik Sipil, dll
            $table->string('jenjang')->default('S1'); // Jenjang (S1, D3, dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};