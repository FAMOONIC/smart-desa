<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    protected $table = 'peraturan';

    protected $fillable = [
        'judul',
        'nomor',
        'tahun',
    ];

    public function poin()
    {
        return $this->hasMany(PeraturanPoin::class)
                    ->orderBy('urutan');
    }
}
