@extends('layouts.auth')

@section('content')
<div class="card shadow p-4" style="width:380px;">
    <h4 class="text-center text-success mb-3">Smart Desa</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input
                type="text"
                name="nik"
                class="form-control"
                placeholder="NIK"
                required
                autofocus
            >
        </div>

        <div class="mb-3">
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="Password"
                required
            >
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div></div>
            <a href="{{ route('password.request') }}"
               class="text-decoration-none small text-muted">
                Lupa password?
            </a>
        </div>

        <button class="btn btn-success w-100">
            Login
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ url('/register') }}" class="text-decoration-none">
            Daftar
        </a>
    </div>
</div>
@endsection
