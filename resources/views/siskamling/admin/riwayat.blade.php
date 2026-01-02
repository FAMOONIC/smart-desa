@extends('layouts.app')

@section('content')

<h4 class="fw-semibold text-success mb-3">Riwayat Siskamling</h4>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-success">
                <tr>
                    <th>Tanggal</th>
                    <th>Grup</th>
                    <th>Jumlah Anggota</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $j)
                    <tr>
                        <td>{{ $j->tanggal }}</td>
                        <td>Grup {{ $j->grup_ke }}</td>
                        <td>{{ $j->anggota_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
