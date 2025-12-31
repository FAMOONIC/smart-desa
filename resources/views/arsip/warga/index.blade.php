@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold text-success">Arsip Desa</h4>
</div>

{{-- FILTER KATEGORI --}}
<div class="mb-3">
    <div class="btn-group">
        <a href="{{ url('/warga/arsip') }}"
           class="btn btn-sm {{ request('kategori') ? 'btn-outline-success' : 'btn-success' }}">
            Semua
        </a>

        @foreach($kategoriList as $kat)
            <a href="{{ url('/warga/arsip?kategori='.$kat) }}"
               class="btn btn-sm {{ request('kategori') === $kat ? 'btn-success' : 'btn-outline-success' }}">
                {{ $kat }}
            </a>
        @endforeach
    </div>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" class="form-control"
               placeholder="Cari judul dokumen..."
               value="{{ request('q') }}">
        <button class="btn btn-success">Cari</button>
    </div>
</form>

{{-- TABLE --}}
<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-success">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>File</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($arsip as $a)
                    <tr>
                        <td>{{ $a->judul }}</td>
                        <td>{{ $a->kategori }}</td>
                        <td>{{ strtoupper($a->file_type) }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-success"
                                    onclick="openPreview({{ $a->id }}, '{{ $a->file_type }}')">
                                Lihat
                            </button>

                            <a href="{{ url('/arsip/'.$a->id.'/download') }}"
                               class="btn btn-sm btn-outline-secondary">
                                Unduh
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Belum ada arsip tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL PREVIEW --}}
<div class="modal fade" id="modalPreview" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="previewContent"
                 style="height:80vh; overflow:auto;">
                <div class="text-center text-muted">
                    Memuat dokumen...
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function openPreview(id, type) {
    const preview = document.getElementById('previewContent');
    type = type.toLowerCase();

    if (['pdf', 'jpg', 'jpeg', 'png'].includes(type)) {
        preview.innerHTML = `
            <iframe src="/arsip/${id}/view"
                    style="width:100%; height:100%; border:none;"></iframe>
        `;
    } else {
        preview.innerHTML = `
            <div class="alert alert-warning">
                Dokumen ini tidak dapat dipratinjau.
                Silakan gunakan tombol <b>Unduh</b>.
            </div>
        `;
    }

    const modal = new bootstrap.Modal(document.getElementById('modalPreview'));
    modal.show();
}
</script>

@endsection
