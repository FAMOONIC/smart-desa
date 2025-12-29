<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;

class WargaProfilController extends Controller
{
    public function index()
    {
        $penduduk = Penduduk::where('user_id', auth()->id())->firstOrFail();
        return view('penduduk.warga.profil', compact('penduduk'));
    }
}
