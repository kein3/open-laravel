<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileShareController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConversationController;

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
    ->middleware(['auth'])
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
Route::middleware(['auth'])->group(function () {
    Route::get('/files', [FileShareController::class, 'index'])->name('files.index');
    Route::post('/files/upload', [FileShareController::class, 'upload'])->name('files.upload');
    Route::get('/files/download/{id}', [FileShareController::class, 'download'])->name('files.download');
    Route::delete('/files/{id}', [FileShareController::class, 'destroy'])->name('files.destroy');
    Route::get('/files/analyze/{id}', [FileShareController::class, 'analyze'])->name('files.analyze');
    Route::get('/openai', [OpenAIController::class, 'index'])->name('openai.index');
    Route::post('/openai', [OpenAIController::class, 'send'])->name('openai.send');

    // Conversations
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/create', [ConversationController::class, 'create'])->name('conversations.create');
    Route::post('/conversations', [ConversationController::class, 'store'])->name('conversations.store');
    Route::get('/conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{id}/messages', [ConversationController::class, 'storeMessage'])->name('conversations.message.store');
    Route::get('/attachments/analyze/{id}', [ConversationController::class, 'analyzeAttachment'])->name('attachments.analyze');
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
