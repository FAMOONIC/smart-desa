<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

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

        return Storage::download($arsip->file_path);
    }
}
