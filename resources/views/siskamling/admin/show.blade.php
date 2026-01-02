@extends('layouts.app')

@section('content')

<a href="/admin/siskamling"
   class="btn btn-sm btn-outline-secondary mb-3">
    Kembali
</a>

<h4 class="fw-semibold text-success">
    Detail Jadwal Siskamling
</h4>

<div class="mb-2 text-muted">
    Tanggal :
    <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</strong>
    <br>
    Grup :
    <strong>{{ $jadwal->grup_ke }}</strong>
</div>

<div class="card">
    <div class="card-body">
        <h6 class="fw-semibold mb-3">Daftar Anggota</h6>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th width="50">No</th>
                    <th>Nama Warga</th>
                    <th>NIK</th>
                </tr>
            </thead>
            <tbody>
            @foreach($jadwal->anggota as $i => $w)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $w->penduduk->nama ?? '-' }}</td>
                    <td>{{ $w->nik }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
