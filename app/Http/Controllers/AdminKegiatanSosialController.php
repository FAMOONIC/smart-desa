<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanSosialController extends Controller
{
    public function index()
    {
        $kegiatan = KegiatanSosial::orderBy('tanggal', 'desc')->get();
        return view('kegiatan-sosial.admin.index', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'      => 'required|string|max:255',
            'tanggal'            => 'required|date',
            'waktu'              => 'nullable|string|max:50',
            'penanggung_jawab'   => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
            'file_bukti'         => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $path = null;
        $type = null;

        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $path = $file->store('kegiatan-sosial');
            $type = $file->getClientOriginalExtension();
        }

        KegiatanSosial::create([
            'nama_kegiatan'    => $request->nama_kegiatan,
            'tanggal'          => $request->tanggal,
            'waktu'            => $request->waktu,
            'penanggung_jawab' => $request->penanggung_jawab,
            'deskripsi'        => $request->deskripsi,
            'file_bukti'       => $path,
            'file_type'        => $type,
        ]);

        return back()->with('success', 'Kegiatan sosial berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $kegiatan = KegiatanSosial::findOrFail($id);

        if ($kegiatan->file_bukti && Storage::exists($kegiatan->file_bukti)) {
            Storage::delete($kegiatan->file_bukti);
        }

        $kegiatan->delete();

        return back()->with('success', 'Kegiatan sosial berhasil dihapus');
    }

    public function download($id)
    {
        $kegiatan = KegiatanSosial::findOrFail($id);

        if (!$kegiatan->file_bukti || !Storage::exists($kegiatan->file_bukti)) {
            abort(404);
        }

        return Storage::download($kegiatan->file_bukti);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan'    => 'required|string|max:255',
            'tanggal'          => 'required|date',
            'waktu'            => 'nullable|date_format:H:i',
            'penanggung_jawab' => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'file_bukti'       => 'nullable|file|max:10240',
        ]);
    
        $kegiatan = KegiatanSosial::findOrFail($id);
    
        if ($request->hasFile('file_bukti')) {
            if ($kegiatan->file_bukti && Storage::exists($kegiatan->file_bukti)) {
                Storage::delete($kegiatan->file_bukti);
            }
        
            $kegiatan->file_bukti = $request->file('file_bukti')
                ->store('kegiatan-sosial');
        }
    
        $kegiatan->update([
            'nama_kegiatan'    => $request->nama_kegiatan,
            'tanggal'          => $request->tanggal,
            'waktu'            => $request->waktu,
            'penanggung_jawab' => $request->penanggung_jawab,
            'deskripsi'        => $request->deskripsi,
        ]);
    
        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui');
    }
    
}