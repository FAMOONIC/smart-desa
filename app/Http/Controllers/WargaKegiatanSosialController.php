<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSosial;
use Illuminate\Support\Facades\Storage;

class WargaKegiatanSosialController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanSosial::orderBy('tanggal', 'desc')->get();
        return view('kegiatan-sosial.warga.index', compact('kegiatan'));
    }

    public function download($id)
    {
        $kegiatan = KegiatanSosial::findOrFail($id);

        if (!$kegiatan->file_bukti || !Storage::exists($kegiatan->file_bukti)) {
            abort(404);
        }

        return Storage::download($kegiatan->file_bukti);
    }
}
