@extends('layouts.app')

@section('content')
<h4 class="mb-3">Antrian Online</h4>

@if($diproses)
<div class="alert alert-info">
    Nomor yang sedang diproses: <strong>{{ $diproses->nomor }}</strong>
</div>
@endif

@if($aktif)
<div class="card p-3 mb-3">
    <p><strong>Nomor Anda:</strong> {{ $aktif->nomor }}</p>
    <p><strong>Status:</strong> {{ ucfirst($aktif->status) }}</p>
</div>
@else
<div class="card p-3">
    <p>
        Klik tombol di bawah untuk mengambil nomor antrian.
        Pastikan Anda benar-benar membutuhkan layanan hari ini.
    </p>

    <form method="POST" action="/warga/antrian"
          onsubmit="return confirm('Apakah Anda yakin ingin mengambil nomor antrian sekarang?')">
        @csrf
        <button class="btn btn-primary">
            Ambil Nomor Antrian
        </button>
    </form>
</div>
@endif

<a href="/warga/antrian/riwayat" class="btn btn-secondary btn-sm mt-3">
    Riwayat Antrian
</a>
@endsection
