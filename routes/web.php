<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileShareController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\DashboardController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {
    Route::get('/files', [FileShareController::class, 'index'])->name('files.index');
    Route::post('/files/upload', [FileShareController::class, 'upload'])->name('files.upload');
    Route::get('/files/download/{id}', [FileShareController::class, 'download'])->name('files.download');
    Route::delete('/files/{id}', [FileShareController::class, 'destroy'])->name('files.destroy');
    Route::get('/files/analyze/{id}', [FileShareController::class, 'analyze'])->name('files.analyze');
    Route::get('/openai', [OpenAIController::class, 'index'])->name('openai.index');
    Route::post('/openai', [OpenAIController::class, 'send'])->name('openai.send');
});


