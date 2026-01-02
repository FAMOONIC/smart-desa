@extends('layouts.app')

@section('content')
<h4 class="fw-semibold text-success">{{ $profil->nama_desa }}</h4>
<p>{{ $profil->alamat }}</p>
<p><strong>Kepala Desa:</strong> {{ $profil->kepala_desa }}</p>
<p>{{ $profil->visi }}</p>
@endsection
