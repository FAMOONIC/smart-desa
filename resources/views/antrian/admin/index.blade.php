@extends('layouts.app')

@section('content')
<h4 class="mb-3">Antrian Hari Ini</h4>

@if($diproses)
<div class="alert alert-info">
    Sedang diproses: <strong>Nomor {{ $diproses->nomor }}</strong>
</div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nomor</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($antrian as $a)
                <tr>
                    <td>{{ $a->nomor }}</td>
                    <td>{{ $a->penduduk->nama }}</td>
                    <td>{{ ucfirst($a->status) }}</td>
                    <td>
                        @if($a->status === 'menunggu')
                        <form method="POST" action="/admin/antrian/{{ $a->id }}/proses" class="d-inline">
                            @csrf
                            <button class="btn btn-primary btn-sm">Proses</button>
                        </form>
                        @endif

                        @if($a->status === 'diproses')
                        <form method="POST" action="/admin/antrian/{{ $a->id }}/selesai" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Selesai</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada antrian</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<a href="/admin/antrian/riwayat" class="btn btn-secondary btn-sm mt-3">Riwayat</a>
@endsection
