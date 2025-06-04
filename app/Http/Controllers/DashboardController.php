<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Exemples de stats ; adaptez à votre schéma
        $stats = [
            'users'   => User::count(),
            'orders'  => DB::table('orders')->count(),
            'revenue' => DB::table('orders')->sum('total'),
        ];

        // Données fictives pour un graphique (6 derniers mois)
        $sales = [120, 190, 300, 500, 260, 340];

        return view('dashboard', compact('stats', 'sales'));
    }
}
