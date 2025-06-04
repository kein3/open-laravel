<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display the intranet dashboard.
     */
    public function index()
    {
        return view('dashboard');
    }
}
