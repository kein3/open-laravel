<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Display the application home page.
     */
    public function index()
    {
        return view('home');
    }
}
