<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSiskamlingAnggota extends Model
{
    use HasFactory;

    protected $table = 'jadwal_siskamling_anggota';

    protected $fillable = [
        'jadwal_id',
        'user_id',
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalSiskamling::class, 'jadwal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
