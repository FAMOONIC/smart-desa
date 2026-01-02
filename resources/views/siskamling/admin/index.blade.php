@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<h4 class="fw-semibold text-success mb-3">Jadwal Siskamling</h4>

<div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="/admin/siskamling/generate" class="row g-3">
            @csrf

            <div class="col-md-4">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Anggota per Grup</label>
                <select name="anggota_per_grup" class="form-select" required>
                    <option value="4">4 Orang</option>
                    <option value="5">5 Orang</option>
                    <option value="6">6 Orang</option>
                </select>
            </div>

            <div class="col-12">
                <button class="btn btn-success">
                    Generate Jadwal
                </button>

                <a href="/admin/siskamling/riwayat"
                   class="btn btn-outline-secondary ms-2">
                    Lihat Riwayat
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-success">
                <tr>
                    <th>Tanggal</th>
                    <th>Grup</th>
                    <th>Jumlah Anggota</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $j)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                        <td>Grup {{ $j->grup_ke }}</td>
                        <td>{{ $j->anggota->count() }} Orang</td>
                        <td>
                            <a href="/admin/siskamling/{{ $j->id }}"
                               class="btn btn-sm btn-outline-success">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center text-muted py-4">
                            Belum ada jadwal aktif.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
