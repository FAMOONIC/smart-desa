@extends('layouts.app')

@section('content')

<a href="/warga/peraturan"
   class="btn btn-sm btn-outline-secondary mb-3">
    Kembali
</a>

<h4 class="fw-semibold">{{ $peraturan->judul }}</h4>

<p class="text-muted">
    Peraturan Nomor {{ $peraturan->nomor }}
    Tahun {{ $peraturan->tahun }}
</p>

<hr>

<ol>
    @foreach($peraturan->poin as $po)
        <li>{{ $po->isi }}</li>
    @endforeach
</ol>

@endsection
