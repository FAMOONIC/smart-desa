@extends('layouts.app')

@section('content')

<h4 class="fw-semibold mb-3">Dashboard Warga</h4>

@if($profilDesa)
<div class="card mb-4">
    <div class="card-body text-center">
        @if($profilDesa->logo)
            <img src="{{ asset('storage/'.$profilDesa->logo) }}"
                 style="width:70px;height:auto" class="mb-2">
        @endif
        <h6>{{ $profilDesa->nama_desa }}</h6>
        <small class="text-muted">{{ $profilDesa->alamat }}</small>
    </div>
</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <h6 class="fw-semibold mb-3">Jadwal Siskamling Anda</h6>
        @forelse($jadwalSiskamling as $j)
            <div class="border rounded p-2 mb-2">
                <strong>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</strong><br>
                Grup {{ $j->grup_ke }}
            </div>
        @empty
            <p class="text-muted mb-0">
                Tidak ada jadwal siskamling aktif
            </p>
        @endforelse
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h6 class="fw-semibold mb-3">Kegiatan Sosial Terbaru</h6>
        @forelse($kegiatanTerbaru as $k)
            <div class="border-bottom pb-2 mb-2">
                <strong>{{ $k->nama_kegiatan }}</strong><br>
                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                </small>
            </div>
        @empty
            <p class="text-muted">Belum ada kegiatan</p>
        @endforelse
    </div>
</div>

@endsection
