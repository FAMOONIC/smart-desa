<?php

namespace App\Http\Controllers;

use App\Models\JadwalSiskamling;
use Illuminate\Support\Facades\Auth;

class WargaSiskamlingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $jadwal = JadwalSiskamling::whereHas('anggota', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->where('is_active', true)
            ->with(['anggota.penduduk'])
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('siskamling.warga.index', compact('jadwal'));
    }

    // public function riwayat()
    // {
    //     $userId = Auth::id();

    //     $jadwal = JadwalSiskamling::whereHas('anggota', function ($q) use ($userId) {
    //             $q->where('user_id', $userId);
    //         })
    //         ->where('is_active', false)
    //         ->with(['anggota.penduduk'])
    //         ->orderBy('tanggal', 'desc')
    //         ->get();

    //     return view('siskamling.warga.riwayat', compact('jadwal'));
    // }

    public function show($id)
    {
        $jadwal = JadwalSiskamling::with(['anggota.penduduk'])
            ->findOrFail($id);

        if (!$jadwal->anggota->contains('id', Auth::id())) {
            abort(403);
        }

        return view('siskamling.warga.show', compact('jadwal'));
    }
}
