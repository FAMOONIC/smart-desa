@extends('layouts.auth')

@section('content')
<div class="card shadow p-4" style="width:380px;">
    <h4 class="text-center text-success mb-3">Password Baru</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Email"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Password Baru"
                   required>
        </div>

        <div class="mb-3">
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Konfirmasi Password"
                   required>
        </div>

        <button class="btn btn-success w-100">
            Reset Password
        </button>
    </form>
</div>
@endsection
