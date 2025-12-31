<?php

namespace App\Services;

use App\Models\Antrian;
use Carbon\Carbon;

class AntrianService
{
    public static function expireOldAntrian(): void
    {
        Antrian::where('tanggal', '<', now()->toDateString())
            ->whereIn('status', ['menunggu', 'diproses'])
            ->update([
                'status' => 'kadaluarsa'
            ]);
    }

}
