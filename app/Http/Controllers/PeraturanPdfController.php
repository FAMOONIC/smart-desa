<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Barryvdh\DomPDF\Facade\Pdf;

class PeraturanPdfController extends Controller
{
    public function download()
    {
        $peraturan = Peraturan::with('poin')
            ->orderBy('tahun', 'desc')
            ->orderBy('nomor')
            ->get();

        $logoPath = public_path('assets/images/logo.png');

        $pdf = Pdf::loadView(
            'peraturan.pdf.cetak',
            compact('peraturan', 'logoPath')
        )->setPaper('A4', 'portrait');

        return $pdf->download('peraturan-desa.pdf');
    }
}
