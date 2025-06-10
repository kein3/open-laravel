<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileShareController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\DashboardController;

// (Décommente si tu ajoutes un vrai contrôleur d’admin)
// use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirection page d’accueil → dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard classique (auth + email vérifié)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profil utilisateur (auth obligatoire)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ===============================
//      ROUTES UTILISATEUR
// ===============================

// Groupe de routes pour la gestion de fichiers (auth obligatoire)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/files', [FileShareController::class, 'index'])->name('files.index');
    Route::post('/files/upload', [FileShareController::class, 'upload'])->name('files.upload');
    Route::get('/files/download/{id}', [FileShareController::class, 'download'])->name('files.download');
    Route::delete('/files/{id}', [FileShareController::class, 'destroy'])->name('files.destroy');
    Route::get('/files/analyze/{id}', [FileShareController::class, 'analyze'])->name('files.analyze');
    Route::get('/openai', [OpenAIController::class, 'index'])->name('openai.index');
    Route::post('/openai', [OpenAIController::class, 'send'])->name('openai.send');
});

// ===============================
//      ROUTES ADMIN PROTÉGÉES
// ===============================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Exemple : test de l'accès admin
        Route::get('/test', function () {
            return 'Espace admin : accès OK !';
        })->name('test');

        // Ici tu pourras ajouter toutes tes routes réservées aux admins
        // Exemple à décommenter si tu ajoutes un vrai contrôleur :
        // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        // Route::resource('users', AdminUserController::class);
    });
