<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penduduk;
use App\Models\JadwalSiskamling;
use Carbon\Carbon;
use DB;

class AdminSiskamlingController extends Controller
{
    public function index()
    {
        $jadwal = JadwalSiskamling::withCount('anggota')
            ->where('is_active', true)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('siskamling.admin.index', compact('jadwal'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'tanggal_mulai'      => 'required|date',
            'tanggal_selesai'    => 'required|date|after_or_equal:tanggal_mulai',
            'anggota_per_grup'   => 'required|integer|min:2|max:10',
        ]);

        $users = User::where('role', 'warga')
            ->whereHas('penduduk')
            ->get()
            ->shuffle();

        if ($users->isEmpty()) {
            return back()->with('error', 'Tidak ada warga untuk dijadwalkan');
        }

        DB::beginTransaction();

        try {

            $tanggalMulai   = Carbon::parse($request->tanggal_mulai);
            $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
            $anggotaPerGrup = (int) $request->anggota_per_grup;

            while ($tanggalMulai->lte($tanggalSelesai)) {

                $chunks = $users->shuffle()->chunk($anggotaPerGrup);
                $grupKe = 1;

                foreach ($chunks as $chunk) {

                    $jadwal = JadwalSiskamling::create([
                        'tanggal'   => $tanggalMulai->format('Y-m-d'),
                        'bulan'     => $tanggalMulai->format('Y-m'),
                        'grup_ke'   => $grupKe,
                        'status'    => 'aktif',
                        'is_active' => true,
                    ]);

                    foreach ($chunk as $user) {
                        $jadwal->anggota()->attach($user->id);
                    }

                    $grupKe++;
                }

                $tanggalMulai->addDay();
            }

            DB::commit();

            return redirect('/admin/siskamling')
                ->with('success', 'Jadwal siskamling berhasil digenerate');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with('error', 'Gagal generate jadwal');
        }
    }

    public function riwayat()
    {
        $jadwal = JadwalSiskamling::withCount('anggota')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('siskamling.admin.riwayat', compact('jadwal'));
    }

    public function show($id)
    {
        $jadwal = JadwalSiskamling::with(['anggota.penduduk'])
            ->findOrFail($id);

        return view('siskamling.admin.show', compact('jadwal'));
    }
}
