<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanSosial extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_sosial';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'penanggung_jawab',
        'deskripsi',
        'file_bukti',
        'file_type',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu'   => 'datetime:H:i',
    ];
}
