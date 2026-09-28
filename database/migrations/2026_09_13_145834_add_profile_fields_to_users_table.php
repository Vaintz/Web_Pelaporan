<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom email
            $table->text('alamat')->nullable()->after('no_hp');
            $table->string('profile_photo')->nullable()->after('alamat');
            
            // Kolom role sebenarnya sudah ada di seeder, tapi kita pastikan strukturnya ada di database
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('pelapor')->after('profile_photo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_hp', 'alamat', 'profile_photo', 'role']);
        });
    }
};