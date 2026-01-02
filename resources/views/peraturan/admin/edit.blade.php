@extends('layouts.app')

@section('content')

<h4 class="fw-semibold mb-3">Edit Peraturan</h4>

<form method="POST" action="{{ url('/admin/peraturan/'.$peraturan->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control"
               value="{{ $peraturan->judul }}" required>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">Nomor</label>
            <input type="number" name="nomor" class="form-control"
                   value="{{ $peraturan->nomor }}" required>
        </div>
        <div class="col">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control"
                   value="{{ $peraturan->tahun }}" required>
        </div>
    </div>

    <label class="form-label">Poin Peraturan</label>

    <div id="poin-wrapper">
        @foreach($peraturan->poin as $p)
            <input type="text" name="poin[]" class="form-control mb-2"
                   value="{{ $p->isi }}" required>
        @endforeach
    </div>

    <button type="button" class="btn btn-sm btn-outline-success mb-3"
            onclick="tambahPoin()">
        + Tambah Poin
    </button>

    <div>
        <a href="{{ url('/admin/peraturan') }}" class="btn btn-secondary">
            Batal
        </a>
        <button class="btn btn-success">Simpan Perubahan</button>
    </div>
</form>

<script>
function tambahPoin() {
    const w = document.getElementById('poin-wrapper');
    const i = document.createElement('input');
    i.type = 'text';
    i.name = 'poin[]';
    i.className = 'form-control mb-2';
    i.required = true;
    w.appendChild(i);
}
</script>

@endsection
