<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class WargaArsipController extends Controller
{
    public function index(Request $request)
    {
        $query = Arsip::query();

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $arsip = $query->orderBy('created_at', 'desc')->get();

        return view('arsip.warga.index', [
            'arsip' => $arsip,
            'kategoriList' => Arsip::kategoriList(),
        ]);
    }
}
