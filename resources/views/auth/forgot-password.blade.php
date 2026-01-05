@extends('layouts.auth')

@section('content')
<div class="card shadow p-4" style="width:380px;">
    <h4 class="text-center text-success mb-3">Reset Password</h4>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Email terdaftar"
                   required>
        </div>

        <button class="btn btn-success w-100">
            Kirim Link Reset
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</div>
@endsection
