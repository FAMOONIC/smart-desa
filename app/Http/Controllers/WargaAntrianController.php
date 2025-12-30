<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Penduduk;
use Carbon\Carbon;

class WargaAntrianController extends Controller
{
    public function index()
    {
        $penduduk = Penduduk::where('user_id', auth()->id())->firstOrFail();
        $hariIni = Carbon::today();

        $aktif = Antrian::where('penduduk_id', $penduduk->id)
            ->whereDate('tanggal', $hariIni)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->first();

        $diproses = Antrian::whereDate('tanggal', $hariIni)
            ->where('status', 'diproses')
            ->first();

        return view('antrian.warga.index', compact('aktif', 'diproses'));
    }

    public function ambil()
    {
        $penduduk = Penduduk::where('user_id', auth()->id())->firstOrFail();
        $hariIni = Carbon::today();

        $masihAktif = Antrian::where('penduduk_id', $penduduk->id)
            ->whereDate('tanggal', $hariIni)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->exists();

        if ($masihAktif) {
            return redirect()->back();
        }

        $nomorTerakhir = Antrian::whereDate('tanggal', $hariIni)->max('nomor');
        $nomorBaru = $nomorTerakhir ? $nomorTerakhir + 1 : 1;

        Antrian::create([
            'penduduk_id' => $penduduk->id,
            'nomor' => $nomorBaru,
            'tanggal' => $hariIni,
            'status' => 'menunggu',
        ]);

        return redirect()->back();
    }

    public function riwayat()
    {
        $penduduk = Penduduk::where('user_id', auth()->id())->firstOrFail();

        $antrian = Antrian::where('penduduk_id', $penduduk->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('nomor')
            ->get();

        return view('antrian.warga.riwayat', compact('antrian'));
    }
}
