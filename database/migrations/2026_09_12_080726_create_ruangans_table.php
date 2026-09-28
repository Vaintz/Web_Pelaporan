<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gedung_id')
                ->constrained('gedungs')
                ->cascadeOnDelete();

            $table->string('lantai');
            $table->string('nama');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangans');
    }
};