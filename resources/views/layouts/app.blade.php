<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Smart Desa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f3f5;
            font-size: 14px;
        }
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0f3d3e, #0b2f30);
            color: #cfd8dc;
            display: flex;
            flex-direction: column;
        }
        .brand {
            padding: 20px;
            font-weight: 600;
            color: #ffffff;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .menu a {
            color: #cfd8dc;
            text-decoration: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .menu a:hover {
            background-color: rgba(255,255,255,.08);
            color: #ffffff;
        }
        .menu a.active {
            background-color: rgba(255,255,255,.15);
            color: #ffffff;
            font-weight: 500;
        }
        .logout {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .logout button {
            background: none;
            border: none;
            color: #cfd8dc;
            padding: 12px 20px;
            width: 100%;
            text-align: left;
        }
        .logout button:hover {
            background-color: rgba(255,255,255,.08);
            color: #ffffff;
        }
        .topbar {
            background-color: #ffffff;
            padding: 12px 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .content {
            padding: 25px;
        }
    </style>
</head>
<body>

@if(auth()->check())
<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            Smart Desa
            <div style="font-size:12px;opacity:.7;">Sistem Informasi Desa</div>
        </div>

        <div class="menu mt-3">
            <a href="/dashboard"
               class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            @if(auth()->user()->role === 'admin')

                <a href="/admin/penduduk"
                   class="{{ request()->is('admin/penduduk*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Penduduk
                </a>

                <a href="/admin/antrian"
                   class="{{ request()->is('admin/antrian*') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i> Antrian Online
                </a>

                <a href="/admin/arsip"
                   class="{{ request()->is('admin/arsip*') ? 'active' : '' }}">
                    <i class="bi bi-archive"></i> Arsip Desa
                </a>

                <a href="/admin/peraturan"
                   class="{{ request()->is('admin/peraturan*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Peraturan Desa
                </a>

                <a href="/admin/siskamling"
                   class="{{ request()->is('admin/siskamling*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-week"></i> Jadwal Siskamling
                </a>

                <a href="#"
                   class="{{ request()->is('admin/kegiatan*') ? 'active' : '' }}">
                    <i class="bi bi-activity"></i> Kegiatan Sosial
                </a>

            @else

                <a href="/warga/profil"
                   class="{{ request()->is('warga/profil') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Profil Saya
                </a>

                <a href="/warga/antrian"
                   class="{{ request()->is('warga/antrian*') ? 'active' : '' }}">
                    <i class="bi bi-list-check"></i> Antrian Online
                </a>

                <a href="/warga/arsip"
                   class="{{ request()->is('warga/arsip*') ? 'active' : '' }}">
                    <i class="bi bi-archive"></i> Arsip Desa
                </a>

                <a href="/warga/peraturan"
                   class="{{ request()->is('warga/peraturan*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Peraturan Desa
                </a>
                
                <a href="/warga/siskamling"
                   class="{{ request()->is('warga/siskamling*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Jadwal Siskamling
                </a>

                <a href="#"
                   class="{{ request()->is('warga/info*') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> Informasi Desa
                </a>

            @endif
        </div>

        <div class="logout">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="flex-grow-1">
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>Dashboard</div>
            <div>{{ auth()->user()->nik }}</div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</div>
@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
