<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
 HEAD
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/', [HomeController::class, 'index']);

 3ed23f4 (Mise à jour de la route d'accueil)

