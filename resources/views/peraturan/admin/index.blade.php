@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold text-success">Peraturan Desa</h4>
    <div>
        <button class="btn btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalCetak">
            Cetak Semua PDF
        </button>

        <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">
            + Tambah Peraturan
        </button>
    </div>
</div>

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
                        <td>{{ $p->nomor }}</td>
                        <td>{{ $p->tahun }}</td>
                        <td>
                            <a href="/admin/peraturan/{{ $p->id }}"
                               class="btn btn-sm btn-outline-success">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="text-center text-muted py-4">
                            Belum ada peraturan ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH PERATURAN --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="/admin/peraturan"
              class="modal-content">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Peraturan Desa</h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Nomor</label>
                        <input type="number"
                               name="nomor"
                               class="form-control"
                               required>
                    </div>
                    <div class="col">
                        <label class="form-label">Tahun</label>
                        <input type="number"
                               name="tahun"
                               class="form-control"
                               required>
                    </div>
                </div>

                <label class="form-label">Poin Peraturan</label>
                <div id="poin-wrapper">
                    <input type="text"
                           name="poin[]"
                           class="form-control mb-2"
                           required>
                </div>

                <button type="button"
                        class="btn btn-sm btn-outline-success"
                        onclick="tambahPoin()">
                    + Tambah Poin
                </button>

            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit"
                        class="btn btn-success">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL KONFIRMASI CETAK --}}
<div class="modal fade" id="modalCetak" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Cetak PDF</h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Cetak seluruh peraturan desa ke dalam file PDF?
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>
                <a href="/peraturan/pdf/download"
                   class="btn btn-success">
                    Cetak
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function tambahPoin() {
    const wrapper = document.getElementById('poin-wrapper');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'poin[]';
    input.className = 'form-control mb-2';
    input.required = true;
    wrapper.appendChild(input);
}
</script>

@endsection
