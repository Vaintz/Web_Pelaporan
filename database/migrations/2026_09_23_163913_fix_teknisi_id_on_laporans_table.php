<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreign('teknisi_id')
                ->references('id')
                ->on('teknisi')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign([
                'teknisi_id'
            ]);
        });
    }
};