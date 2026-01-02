@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold text-success">Kegiatan Sosial</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Kegiatan
    </button>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped mb-0 align-middle">
            <thead class="table-success">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Deskripsi</th>
                    <th>Penanggung Jawab</th>
                    <th>Bukti</th>
                    <th width="200">Aksi</th>
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
                                <a href="/admin/kegiatan-sosial/{{ $k->id }}/download"
                                   class="btn btn-sm btn-outline-secondary">
                                    Unduh
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $k->id }}">
                                    Edit
                                </button>

                                <form method="POST"
                                      action="/admin/kegiatan-sosial/{{ $k->id }}"
                                      onsubmit="return confirm('Hapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEdit{{ $k->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST"
                                  action="/admin/kegiatan-sosial/{{ $k->id }}"
                                  enctype="multipart/form-data"
                                  class="modal-content">
                                @csrf
                                @method('PUT')

                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Edit Kegiatan Sosial</h5>
                                    <button type="button"
                                            class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body bg-white">

                                    <div class="mb-3">
                                        <label class="form-label">Nama Kegiatan</label>
                                        <input type="text"
                                               name="nama_kegiatan"
                                               class="form-control"
                                               value="{{ $k->nama_kegiatan }}"
                                               required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date"
                                                   name="tanggal"
                                                   class="form-control"
                                                   value="{{ $k->tanggal }}"
                                                   required>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Waktu</label>
                                            <input type="time"
                                                   name="waktu"
                                                   class="form-control"
                                                   value="{{ $k->waktu }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Penanggung Jawab</label>
                                        <input type="text"
                                               name="penanggung_jawab"
                                               class="form-control"
                                               value="{{ $k->penanggung_jawab }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi"
                                                  class="form-control"
                                                  rows="3">{{ $k->deskripsi }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">File Bukti (Opsional)</label>
                                        <input type="file"
                                               name="file_bukti"
                                               class="form-control"
                                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-success">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada kegiatan sosial.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="/admin/kegiatan-sosial"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Kegiatan Sosial</h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-white">

                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text"
                           name="nama_kegiatan"
                           class="form-control"
                           required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               required>
                    </div>
                    <div class="col">
                        <label class="form-label">Waktu</label>
                        <input type="time"
                               name="waktu"
                               class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penanggung Jawab</label>
                    <input type="text"
                           name="penanggung_jawab"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Bukti</label>
                    <input type="file"
                           name="file_bukti"
                           class="form-control"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <small class="text-muted">Maksimal 10 MB</small>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
