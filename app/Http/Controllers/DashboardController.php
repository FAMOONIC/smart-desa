<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penduduk;
use App\Models\ProfilDesa;
use App\Models\KegiatanSosial;
use App\Models\JadwalSiskamling;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return Auth::user()->role === 'admin'
            ? $this->admin()
            : $this->warga();
    }

    public function admin()
    {
        $profilDesa = ProfilDesa::first();

        $statistik = [
            'penduduk'         => Penduduk::count(),
            'warga'            => User::where('role', 'warga')->count(),
            'kegiatan'         => KegiatanSosial::count(),
            'siskamling_aktif' => JadwalSiskamling::where('is_active', true)->count(),
        ];

        $chartData = [
            'labels' => [
                'Penduduk',
                'Warga',
                'Kegiatan Sosial',
                'Siskamling Aktif',
            ],
            'values' => array_values($statistik),
        ];

        $kegiatanTerbaru = KegiatanSosial::orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact(
            'profilDesa',
            'statistik',
            'chartData',
            'kegiatanTerbaru'
        ));
    }

    public function warga()
    {
        $profilDesa = ProfilDesa::first();

        $kegiatanTerbaru = KegiatanSosial::orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        $jadwalSiskamling = JadwalSiskamling::whereHas('anggota', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('is_active', true)
            ->orderBy('tanggal')
            ->get();

        return view('dashboard.warga', compact(
            'profilDesa',
            'kegiatanTerbaru',
            'jadwalSiskamling'
        ));
    }
}
