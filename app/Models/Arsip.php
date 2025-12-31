<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip_desa';

    protected $fillable = [
        'judul',
        'kategori',
        'deskripsi',
        'file_path',
        'file_type',
        'uploaded_by',
    ];

    public static function kategoriList(): array
    {
        return [
            'Peraturan Desa',
            'Keuangan',
            'Administrasi',
            'Sosial',
            'Kegiatan',
        ];
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
