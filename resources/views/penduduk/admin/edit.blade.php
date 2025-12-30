@extends('layouts.app')

@section('content')
<h4>Edit Data Penduduk</h4>

<form method="POST" action="/admin/penduduk/{{ $penduduk->id }}">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Nama</label>
        <input name="nama" class="form-control" value="{{ $penduduk->nama }}">
    </div>

    <div class="mb-2">
        <label>Tempat Lahir</label>
        <input name="tempat_lahir" class="form-control" value="{{ $penduduk->tempat_lahir }}">
    </div>

    <div class="mb-2">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $penduduk->tanggal_lahir }}">
    </div>

    <div class="mb-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ $penduduk->alamat }}</textarea>
    </div>

    <div class="row">
        <div class="col">
            <label>RT</label>
            <input name="rt" class="form-control" value="{{ $penduduk->rt }}">
        </div>
        <div class="col">
            <label>RW</label>
            <input name="rw" class="form-control" value="{{ $penduduk->rw }}">
        </div>
    </div>

    <div class="mb-3 mt-2">
        <label>Pekerjaan</label>
        <input name="pekerjaan" class="form-control" value="{{ $penduduk->pekerjaan }}">
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="/admin/penduduk" class="btn btn-secondary">Batal</a>
</form>
@endsection
