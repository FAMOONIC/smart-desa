<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSiskamling extends Model
{
    protected $table = 'jadwal_siskamling';

    protected $fillable = [
        'tanggal',
        'bulan',
        'status',
        'grup_ke',
        'is_active',
    ];

    public function anggota()
    {
        return $this->belongsToMany(
            User::class,
            'jadwal_siskamling_anggota',
            'jadwal_id',
            'user_id'
        );
    }
}
