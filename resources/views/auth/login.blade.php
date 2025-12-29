@extends('layouts.auth')

@section('content')
<div class="card shadow p-4" style="width:380px;">
    <h4 class="text-center text-success mb-3">Smart Desa</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <input type="text" name="nik" class="form-control" placeholder="NIK" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="/register">Daftar</a>
    </div>
</div>
@endsection
