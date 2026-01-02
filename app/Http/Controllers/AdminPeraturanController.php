<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use App\Models\PeraturanPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::with('poin')
            ->orderBy('tahun', 'desc')
            ->orderBy('nomor')
            ->get();

        return view('peraturan.admin.index', compact('peraturan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor' => 'required|integer',
            'tahun' => 'required|integer',
            'poin'  => 'required|array|min:1',
            'poin.*'=> 'required|string'
        ]);

        DB::transaction(function () use ($request) {

            $peraturan = Peraturan::create([
                'judul' => $request->judul,
                'nomor' => $request->nomor,
                'tahun' => $request->tahun,
            ]);

            foreach ($request->poin as $i => $isi) {
                PeraturanPoin::create([
                    'peraturan_id' => $peraturan->id,
                    'isi' => $isi,
                    'urutan' => $i + 1,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Peraturan berhasil ditambahkan');
    }

    public function show($id)
    {
        $peraturan = Peraturan::with('poin')->findOrFail($id);
        return view('peraturan.admin.show', compact('peraturan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'nomor' => 'required|integer',
            'tahun' => 'required|integer',
            'poin'  => 'required|array|min:1',
            'poin.*'=> 'required|string'
        ]);
    
        DB::transaction(function () use ($request, $id) {
        
            $peraturan = Peraturan::findOrFail($id);
            $peraturan->update($request->only('judul','nomor','tahun'));
        
            PeraturanPoin::where('peraturan_id', $id)->delete();
        
            foreach ($request->poin as $i => $isi) {
                PeraturanPoin::create([
                    'peraturan_id' => $id,
                    'isi' => $isi,
                    'urutan' => $i + 1,
                ]);
            }
        });
    
        return redirect('/admin/peraturan')
               ->with('success', 'Peraturan berhasil diperbarui');
    }


    public function edit($id)
    {
        $peraturan = Peraturan::with('poin')->findOrFail($id);
        return view('peraturan.admin.edit', compact('peraturan'));
    }


    public function destroy($id)
    {
        Peraturan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Peraturan berhasil dihapus');
    }
}
