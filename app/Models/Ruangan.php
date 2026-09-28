<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable = [
        'gedung_id',
        'lantai',
        'nama',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}