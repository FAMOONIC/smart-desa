@extends('layouts.app')

@section('content')
<h4>Profil Saya</h4>

<div class="card p-3 bg-white">
    <p><strong>NIK:</strong> {{ $penduduk->nik }}</p>
    <p><strong>Nama:</strong> {{ $penduduk->nama }}</p>
    <p><strong>TTL:</strong> {{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir }}</p>
    <p><strong>Alamat:</strong> {{ $penduduk->alamat }}</p>
    <p><strong>RT/RW:</strong> {{ $penduduk->rt }}/{{ $penduduk->rw }}</p>
    <p><strong>Pekerjaan:</strong> {{ $penduduk->pekerjaan }}</p>
    <p><strong>Status:</strong> {{ ucfirst($penduduk->status) }}</p>
</div>
@endsection
