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

    public function show($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('penduduk.admin.show', compact('penduduk'));
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('penduduk.admin.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'pekerjaan' => 'required',
        ]);

        Penduduk::where('id', $id)->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect('/admin/penduduk');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aktif,pindah,meninggal,nonaktif',
        ]);

        Penduduk::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back();
    }
}
