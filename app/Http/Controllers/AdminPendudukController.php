<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class AdminPendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('nik', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $penduduk = $query->orderBy('nama')->get();

        return view('penduduk.admin.index', compact('penduduk'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,pindah,meninggal',
        ]);

        Penduduk::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back();
    }
}
