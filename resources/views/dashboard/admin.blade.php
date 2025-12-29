@extends('layouts.app')

@section('content')
<h4 class="mb-4">Dashboard</h4>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card card-stat shadow-sm p-3">
            <div class="text-muted">Total Penduduk</div>
            <div class="fs-4 fw-semibold">2.847</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat shadow-sm p-3">
            <div class="text-muted">Jumlah Keluarga</div>
            <div class="fs-4 fw-semibold">687</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat shadow-sm p-3">
            <div class="text-muted">Kegiatan Bulan Ini</div>
            <div class="fs-4 fw-semibold">12</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat shadow-sm p-3">
            <div class="text-muted">Antrian Aktif</div>
            <div class="fs-4 fw-semibold">8</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm p-3">
            <h6>Pengumuman Terbaru</h6>
            <ul class="mb-0">
                <li>Gotong Royong Desa – 15 Des 2025</li>
                <li>Bantuan Sosial Tersedia – 12 Des 2025</li>
                <li>Rapat RT/RW – 10 Des 2025</li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm p-3">
            <h6>Profil Desa</h6>
            <div>Nama Desa: Jawir</div>
            <div>Kepala Desa: Bapak Radja</div>
            <div>Kecamatan: Sejahtera</div>
            <div>Kabupaten: Jawir Jaya</div>
        </div>
    </div>
</div>
@endsection
