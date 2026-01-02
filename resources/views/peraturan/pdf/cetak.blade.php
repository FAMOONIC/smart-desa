<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo {
            width: 90px;
        }

        .logo img {
            width: 90px;
            height: auto;
            display: block;
        }

        .title {
            text-align: center;
        }

        .title h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .title p {
            margin: 2px 0 0;
            font-size: 13px;
            font-weight: bold;
        }

        .print-info {
            width: 120px;
            text-align: right;
            font-size: 11px;
        }

        .line {
            border-bottom: 1px solid #000;
            margin: 10px 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background: #e9ecef;
            text-align: center;
        }

        ol {
            margin: 5px 0 15px 20px;
        }
    </style>
</head>
<body>

<div class="header">
    <table class="header-table">
        <tr>
            <td class="logo">
                <img src="{{ public_path('assets/images/logo.png') }}">
            </td>

            <td class="title">
                <h3>PEMERINTAH DESA</h3>
                <p>DAFTAR PERATURAN DESA</p>
            </td>

            <td class="print-info">
                <div>Dicetak:</div>
                <strong>{{ now()->format('d-m-Y') }}</strong>
            </td>
        </tr>
    </table>
</div>

<div class="line"></div>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Judul</th>
            <th width="15%">Nomor</th>
            <th width="15%">Tahun</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peraturan as $i => $p)
            <tr>
                <td style="text-align:center">{{ $i + 1 }}</td>
                <td>{{ $p->judul }}</td>
                <td style="text-align:center">{{ $p->nomor }}</td>
                <td style="text-align:center">{{ $p->tahun }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@foreach($peraturan as $p)
    <strong>{{ $p->judul }}</strong><br>
    <small>Peraturan Nomor {{ $p->nomor }} Tahun {{ $p->tahun }}</small>

    <ol>
        @foreach($p->poin as $po)
            <li>{{ $po->isi }}</li>
        @endforeach
    </ol>
@endforeach

</body>
</html>