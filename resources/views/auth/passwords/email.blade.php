@extends('layouts.auth')

@section('content')
<h4>Lupa Password</h4>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="/forgot-password">
    @csrf

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <button class="btn btn-success w-100">
        Kirim Link Reset
    </button>
</form>
@endsection
