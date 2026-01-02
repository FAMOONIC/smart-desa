@extends('layouts.app')

@section('content')

<h4 class="fw-bold mb-1">Dashboard Admin</h4>
<p class="text-muted mb-4">Selamat datang di Sistem Informasi Desa</p>

{{-- STATISTIK --}}
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card p-3">
            <small>Total Penduduk</small>
            <h4 class="fw-bold">{{ $statistik['penduduk'] }}</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <small>Jumlah Warga</small>
            <h4 class="fw-bold">{{ $statistik['warga'] }}</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <small>Kegiatan Sosial</small>
            <h4 class="fw-bold">{{ $statistik['kegiatan'] }}</h4>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <small>Siskamling Aktif</small>
            <h4 class="fw-bold">{{ $statistik['siskamling_aktif'] }}</h4>
        </div>
    </div>

</div>

{{-- GRAFIK --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Statistik Sistem Desa</h6>
        <canvas id="statistikChart" height="90"></canvas>
    </div>
</div>

{{-- KEGIATAN TERBARU --}}
<div class="card">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Kegiatan Sosial Terbaru</h6>

        <ul class="list-group list-group-flush">
            @forelse($kegiatanTerbaru as $k)
                <li class="list-group-item">
                    <strong>{{ $k->nama_kegiatan }}</strong><br>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}
                    </small>
                </li>
            @empty
                <li class="list-group-item text-muted">
                    Belum ada kegiatan sosial
                </li>
            @endforelse
        </ul>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('statistikChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartData['labels']),
        datasets: [{
            label: 'Jumlah',
            data: @json($chartData['values']),
            backgroundColor: [
                '#198754',
                '#0d6efd',
                '#ffc107',
                '#6f42c1'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});
</script>
@endpush
