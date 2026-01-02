@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h4 class="fw-semibold text-success mb-3">Profil Desa</h4>

<div class="card">
    <div class="card-body">

        <form method="POST"
              action="/admin/profil-desa"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Desa</label>
                <input type="text"
                       name="nama_desa"
                       class="form-control"
                       value="{{ old('nama_desa', $profil->nama_desa) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="2"
                          required>{{ old('alamat', $profil->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kepala Desa</label>
                <input type="text"
                       name="kepala_desa"
                       class="form-control"
                       value="{{ old('kepala_desa', $profil->kepala_desa) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $profil->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text"
                       name="telepon"
                       class="form-control"
                       value="{{ old('telepon', $profil->telepon) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Visi</label>
                <textarea name="visi"
                          class="form-control"
                          rows="3">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Misi</label>
                <textarea name="misi"
                          class="form-control"
                          rows="3">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Logo Desa</label>
                <input type="file"
                       name="logo"
                       class="form-control">

                @if($profil->logo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$profil->logo) }}"
                             height="80"
                             alt="Logo Desa">
                    </div>
                @endif
            </div>

            <button class="btn btn-success">
                Simpan Perubahan
            </button>

        </form>

    </div>
</div>

@endsection
