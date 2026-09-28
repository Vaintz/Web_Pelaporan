<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisi';

    protected $fillable = [
        'nama',
        'status',
    ];

    public function laporan()
    {
        return $this->hasMany(
            Laporan::class,
            'teknisi_id'
        );
    }
}