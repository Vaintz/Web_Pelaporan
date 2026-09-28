<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKerusakan extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}