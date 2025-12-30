@extends('layouts.app')

@section('content')
<h4 class="mb-3">Riwayat Antrian Saya</h4>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($antrian as $a)
                <tr>
                    <td>{{ $a->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $a->nomor }}</td>
                    <td>{{ ucfirst($a->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<a href="/warga/antrian" class="btn btn-secondary btn-sm mt-3">Kembali</a>
@endsection
