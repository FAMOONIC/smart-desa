<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return Auth::user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/warga/dashboard');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function warga()
    {
        return view('dashboard.warga');
    }
}
