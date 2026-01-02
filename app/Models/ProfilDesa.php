<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    protected $fillable = [
        'nama_desa',
        'alamat',
        'kepala_desa',
        'email',
        'telepon',
        'visi',
        'misi',
        'logo',
    ];
}
