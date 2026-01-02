@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold text-success">Preview Peraturan Desa</h4>
    <div>
        <a href="{{ url('/admin/peraturan') }}" class="btn btn-secondary">
            Batal
        </a>
        <a href="{{ url('/peraturan/pdf/download') }}" class="btn btn-success">
            Cetak / Unduh PDF
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">

        @include('peraturan.pdf.cetak', ['preview' => true])

    </div>
</div>

@endsection
