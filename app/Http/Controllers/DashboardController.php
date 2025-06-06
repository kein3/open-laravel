<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileShare;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $fileCount = FileShare::count();
        $lastFiles = FileShare::latest()->take(5)->get();
        $userCount = User::count();

        // Si tu ajoutes l'historique d'analyse OpenAI plus tard :
        // $analysisCount = \DB::table('analyses')->count();

        return view('dashboard', [
            'fileCount' => $fileCount,
            'lastFiles' => $lastFiles,
            'userCount' => $userCount,
            // 'analysisCount' => $analysisCount ?? 0,
        ]);
    }
}
