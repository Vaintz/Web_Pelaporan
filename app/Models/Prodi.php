<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_prodi',
        'jenjang',
    ];

    // Relasi: Satu prodi bisa dimiliki oleh banyak user/mahasiswa/dosen
    public function users()
    {
        return $this->hasMany(User::class, 'program_studi', 'nama_prodi');
    }
}