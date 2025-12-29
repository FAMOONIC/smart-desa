@extends('layouts.app')

@section('content')
<h4>Data Penduduk</h4>

<form class="row g-2 mb-3">
    <div class="col">
        <input name="search" class="form-control" placeholder="Cari nama / NIK">
    </div>
    <div class="col">
        <select name="status" class="form-control">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="pindah">Pindah</option>
            <option value="meninggal">Meninggal</option>
        </select>
    </div>
    <div class="col">
        <button class="btn btn-secondary">Filter</button>
    </div>
</form>

<table class="table table-bordered bg-white">
    <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>RT/RW</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($penduduk as $p)
    <tr>
        <td>{{ $p->nik }}</td>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->rt }}/{{ $p->rw }}</td>
        <td>{{ ucfirst($p->status) }}</td>
        <td>
            <form method="POST" action="/admin/penduduk/{{ $p->id }}/status">
                @csrf
                <select name="status" onchange="this.form.submit()">
                    <option value="aktif" {{ $p->status=='aktif'?'selected':'' }}>Aktif</option>
                    <option value="pindah" {{ $p->status=='pindah'?'selected':'' }}>Pindah</option>
                    <option value="meninggal" {{ $p->status=='meninggal'?'selected':'' }}>Meninggal</option>
                </select>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
