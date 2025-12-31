<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminArsipController extends Controller
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

        return view('arsip.admin.index', [
            'arsip' => $arsip,
            'kategoriList' => Arsip::kategoriList(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required|string|max:255',
                'kategori' => 'required|in:' . implode(',', Arsip::kategoriList()),
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png,docx,xlsx|max:10240',
            ],
            [
                'judul.required' => 'Judul arsip wajib diisi.',
                'kategori.required' => 'Kategori arsip wajib dipilih.',
                'kategori.in' => 'Kategori arsip tidak valid.',
                'file.required' => 'File dokumen wajib diunggah.',
                'file.file' => 'File yang diunggah tidak valid.',
                'file.mimes' => 'Format file tidak diizinkan. Gunakan PDF, JPG, PNG, DOCX, atau XLSX.',
                'file.max' => 'Ukuran file maksimal 10 MB.',
            ]
        );
    
        $file = $request->file('file');
    
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    
        $path = $file->storeAs('arsip', $filename);
    
        Arsip::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'uploaded_by' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'Arsip berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        Storage::delete($arsip->file_path);
        $arsip->delete();

        return redirect()->back()->with('success', 'Arsip berhasil dihapus');
    }
}
