@extends('layouts.app')

@section('content')

<a href="/warga/siskamling"
   class="btn btn-sm btn-outline-secondary mb-3">
    Kembali
</a>

<h4 class="fw-semibold text-success mb-3">
    Jadwal {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
</h4>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Grup:</strong> {{ $jadwal->grup_ke }}</p>
        <p><strong>Status:</strong> {{ ucfirst($jadwal->status) }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header bg-success text-white">
        Anggota Grup
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIK</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal->anggota as $user)
                    <tr>
                        <td>{{ $user->penduduk->nama ?? '-' }}</td>
                        <td>{{ $user->nik }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
