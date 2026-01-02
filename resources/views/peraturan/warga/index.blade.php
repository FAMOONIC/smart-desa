@extends('layouts.app')

@section('content')

<h4 class="fw-semibold text-success mb-3">Peraturan Desa</h4>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-success">
                <tr>
                    <th>Judul</th>
                    <th width="120">Nomor</th>
                    <th width="120">Tahun</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturan as $p)
                    <tr>
                        <td>{{ $p->judul }}</td>
                        <td class="text-center">{{ $p->nomor }}</td>
                        <td class="text-center">{{ $p->tahun }}</td>
                        <td class="text-center">
                            <a href="/warga/peraturan/{{ $p->id }}"
                               class="btn btn-sm btn-outline-success">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center text-muted py-4">
                            Belum ada peraturan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
