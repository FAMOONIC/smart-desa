<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;

class WargaPeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::select('id', 'judul', 'nomor', 'tahun')
            ->orderBy('tahun', 'desc')
            ->orderBy('nomor')
            ->get();

        return view('peraturan.warga.index', compact('peraturan'));
    }

    public function show($id)
    {
        $peraturan = Peraturan::with('poin')
            ->select('id', 'judul', 'nomor', 'tahun')
            ->findOrFail($id);

        return view('peraturan.warga.show', compact('peraturan'));
    }
}
