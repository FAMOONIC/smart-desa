<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArsipFileController extends Controller
{
    public function view($id)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $arsip = Arsip::findOrFail($id);

        if (!Storage::exists($arsip->file_path)) {
            abort(404);
        }

        $mime = Storage::mimeType($arsip->file_path);
        $content = Storage::get($arsip->file_path);

        return response($content, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline');
    }

    public function download($id)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $arsip = Arsip::findOrFail($id);

        if (!Storage::exists($arsip->file_path)) {
            abort(404);
        }

        if (strtolower($arsip->file_type) !== 'pdf') {
            return Storage::download($arsip->file_path);
        }

        $pdfPath  = Storage::path($arsip->file_path);
        $logoPath = storage_path('app/watermark/logo.png');

        $user = Auth::user();
        $watermarkText = sprintf(
            'Diunduh oleh: %s | %s',
            $user->nik ?? $user->email,
            now()->format('d-m-Y H:i')
        );

        $pdf = new \setasign\Fpdi\Fpdi();
        $pageCount = $pdf->setSourceFile($pdfPath);

        for ($i = 1; $i <= $pageCount; $i++) {
            $tpl  = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tpl);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($tpl);

            /* LOGO WATERMARK */
            if (file_exists($logoPath)) {
                $logoWidth = 28;
                $logoX = $size['width'] - $logoWidth - 15;
                $logoY = $size['height'] - 25;

                $pdf->Image($logoPath, $logoX, $logoY, $logoWidth);
            }

            /* TEKS AUDIT */
            $pdf->SetFont('Helvetica', '', 7);
            $pdf->SetTextColor(120, 120, 120);

            $pdf->SetXY(15, $size['height'] - 26);
            $pdf->Cell(0, 5, $watermarkText, 0, 0, 'L');
        }

        return response($pdf->Output('S'), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="arsip-'.$arsip->id.'.pdf"',
        ]);
    }
}
