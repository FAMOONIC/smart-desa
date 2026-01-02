<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeraturanPoin extends Model
{
    protected $table = 'peraturan_poin';

    protected $fillable = [
        'peraturan_id',
        'isi',
        'urutan',
    ];

    public function peraturan()
    {
        return $this->belongsTo(Peraturan::class);
    }
}
