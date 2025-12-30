@extends('layouts.app')

@section('content')
<h4 class="mb-3">Data Penduduk</h4>

<form class="row g-2 mb-3">
    <div class="col-md-4">
        <input name="search" class="form-control" placeholder="Cari Nama / NIK" value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">Semua Status</option>
            <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
            <option value="pindah" {{ request('status')=='pindah'?'selected':'' }}>Pindah</option>
            <option value="meninggal" {{ request('status')=='meninggal'?'selected':'' }}>Meninggal</option>
            <option value="nonaktif" {{ request('status')=='nonaktif'?'selected':'' }}>Nonaktif</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-secondary w-100">Filter</button>
    </div>
</form>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>RT/RW</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penduduk as $p)
                <tr>
                    <td>{{ $p->nik }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->rt }}/{{ $p->rw }}</td>
                    <td>
                        <form method="POST" action="/admin/penduduk/{{ $p->id }}/status">
                            @csrf
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="aktif" {{ $p->status=='aktif'?'selected':'' }}>Aktif</option>
                                <option value="pindah" {{ $p->status=='pindah'?'selected':'' }}>Pindah</option>
                                <option value="meninggal" {{ $p->status=='meninggal'?'selected':'' }}>Meninggal</option>
                                <option value="nonaktif" {{ $p->status=='nonaktif'?'selected':'' }}>Nonaktif</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="/admin/penduduk/{{ $p->id }}" class="btn btn-info btn-sm">
                            Detail
                        </a>
                        <a href="/admin/penduduk/{{ $p->id }}/edit" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
