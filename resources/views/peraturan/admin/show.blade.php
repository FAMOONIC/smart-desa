@extends('layouts.app')

@section('content')

<a href="{{ url('/admin/peraturan') }}" class="btn btn-sm btn-secondary mb-3">
    Kembali
</a>

<div class="card">
    <div class="card-body">
        <h5 class="fw-semibold">{{ $peraturan->judul }}</h5>
        <p class="text-muted">
            Peraturan Desa Nomor {{ $peraturan->nomor }} Tahun {{ $peraturan->tahun }}
        </p>

        <hr>

        <ol>
            @foreach($peraturan->poin as $p)
                <li>{{ $p->isi }}</li>
            @endforeach
        </ol>

        <div class="mt-3">
            <a href="{{ url('/admin/peraturan/'.$peraturan->id.'/edit') }}"
               class="btn btn-primary">
                Edit
            </a>
            
            <form action="{{ url('/admin/peraturan/'.$peraturan->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Hapus peraturan ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>

@endsection
