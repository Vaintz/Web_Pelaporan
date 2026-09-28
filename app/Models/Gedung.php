<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $fillable = [
        'nama',
    ];

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}