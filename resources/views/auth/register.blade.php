@extends('layouts.app')

@section('content')
<div class="card shadow p-4" style="width:450px;">
    <h4 class="text-center text-primary mb-3">Pendaftaran Warga</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div class="mb-2">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>

        <div class="row">
            <div class="col">
                <label class="form-label">RT</label>
                <input type="text" name="rt" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">RW</label>
                <input type="text" name="rw" class="form-control" required>
            </div>
        </div>

        <div class="mb-2 mt-2">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Email (opsional)</label>
            <input type="email" name="email" class="form-control">
        </div>


        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Daftar</button>
    </form>

    <div class="text-center mt-3">
        <small>Sudah punya akun? <a href="/login">Login</a></small>
    </div>
</div>
@endsection
