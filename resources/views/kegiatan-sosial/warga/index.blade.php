@extends('layouts.app')

@section('content')

<h4 class="fw-semibold text-success mb-3">Kegiatan Sosial Desa</h4>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0 align-middle">
            <thead class="table-success">
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Deskripsi</th>
                    <th>Penanggung Jawab</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $k)
                    <tr>
                        <td>{{ $k->nama_kegiatan }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                        </td>

                        <td>{{ $k->waktu ?? '-' }}</td>

                        <td title="{{ $k->deskripsi }}">
                            {{ \Illuminate\Support\Str::limit($k->deskripsi, 60, '...') }}
                        </td>

                        <td>{{ $k->penanggung_jawab }}</td>

                        <td>
                            @if($k->file_bukti)
                                <a href="/warga/kegiatan-sosial/{{ $k->id }}/download"
                                   class="btn btn-sm btn-outline-secondary">
                                    Unduh
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="text-center text-muted py-4">
                            Belum ada kegiatan sosial.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
