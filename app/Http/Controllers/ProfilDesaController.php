<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    public function index()
    {
        // Pastikan selalu ada 1 data profil desa
        $profil = ProfilDesa::firstOrCreate([]);

        return view('profil-desa.admin.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilDesa::firstOrCreate([]);

        $request->validate([
            'nama_desa'     => 'required|string|max:255',
            'alamat'        => 'required|string',
            'kepala_desa'   => 'required|string|max:255',
            'email'         => 'nullable|email',
            'telepon'       => 'nullable|string|max:20',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'logo'          => 'nullable|image|max:2048',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            if ($profil->logo && Storage::disk('public')->exists($profil->logo)) {
                Storage::disk('public')->delete($profil->logo);
            }

            $data['logo'] = $request->file('logo')->store('desa', 'public');
        }

        $profil->update($data);

        return redirect('/dashboard')
            ->with('success', 'Profil desa berhasil diperbarui');

    }

    public function warga()
    {
        $profil = ProfilDesa::firstOrCreate([]);

        return view('profil-desa.warga.index', compact('profil'));
    }
}
