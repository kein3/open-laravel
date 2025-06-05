<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;

// Route temporaire pour assigner le rôle "admin" à l'utilisateur ID=1
Route::get('/assign-admin-temp', function () {
    $user = User::find(1);
    if (! $user) {
        return "L'utilisateur ID=1 n'existe pas";
    }
    // Vérifie si l'utilisateur n'a pas déjà le rôle
    if ($user->hasRole('admin')) {
        return "L'utilisateur ID=1 a déjà le rôle \"admin\"";
    }
    $user->assignRole('admin');
    return "Le rôle \"admin\" a bien été attribué à l'utilisateur ID=1";
});
