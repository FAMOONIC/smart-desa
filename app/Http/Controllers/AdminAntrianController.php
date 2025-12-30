<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Carbon\Carbon;

class AdminAntrianController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $diproses = Antrian::whereDate('tanggal', $hariIni)
            ->where('status', 'diproses')
            ->first();

        $antrian = Antrian::whereDate('tanggal', $hariIni)
            ->orderBy('nomor')
            ->get();

        return view('antrian.admin.index', compact('antrian', 'diproses'));
    }

    public function proses($id)
    {
        $hariIni = Carbon::today();

        Antrian::whereDate('tanggal', $hariIni)
            ->where('status', 'diproses')
            ->update(['status' => 'menunggu']);

        Antrian::where('id', $id)->update([
            'status' => 'diproses'
        ]);

        return redirect()->back();
    }

    public function selesai($id)
    {
        Antrian::where('id', $id)->update([
            'status' => 'selesai'
        ]);

        return redirect()->back();
    }

    public function riwayat()
    {
        $antrian = Antrian::orderBy('tanggal', 'desc')
            ->orderBy('nomor')
            ->get();

        return view('antrian.admin.riwayat', compact('antrian'));
    }
}
