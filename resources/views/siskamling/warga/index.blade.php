@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold text-success mb-0">
        Jadwal Siskamling Saya
    </h4>

    <!-- <a href="/warga/siskamling/riwayat"
       class="btn btn-sm btn-outline-secondary">
        Riwayat
    </a> -->
</div>


<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">

            <thead class="table-success">
                <tr>
                    <th>Tanggal</th>
                    <th>Grup</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $j)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                        <td>Grup {{ $j->grup_ke }}</td>
                        <td>{{ ucfirst($j->status) }}</td>
                        <td>
                            <a href="/warga/siskamling/{{ $j->id }}"
                               class="btn btn-sm btn-outline-success">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada jadwal siskamling.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
