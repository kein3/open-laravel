<?php

use Illuminate\Support\Facades\Route;
HEAD
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']);

use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Routes web
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
     ->name('dashboard');   // page d’accueil
0af99fe (home)
