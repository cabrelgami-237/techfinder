<?php

use App\Http\Controllers\web\competencesController;
use App\Http\Controllers\web\UtilisateurController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

// Routes pour les compétences
Route::prefix('competences')->group(function () {
    Route::get('/', [competencesController::class, 'index'])->name('competences.index');
    Route::post('/', [competencesController::class, 'store'])->name('competences.store');
    Route::get('/{id}/edit', [competencesController::class, 'edit'])->name('competences.edit');
    Route::put('/{id}', [competencesController::class, 'update'])->name('competences.update');
    Route::delete('/{id}', [competencesController::class, 'destroy'])->name('competences.destroy');
});

// Routes pour les utilisateurs
Route::prefix('utilisateurs')->group(function () {
    Route::get('/', [UtilisateurController::class, 'index'])->name('utilisateurs.index');
    Route::post('/', [UtilisateurController::class, 'store'])->name('utilisateurs.store');
    Route::get('/{id}/edit', [UtilisateurController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/{id}', [UtilisateurController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/{id}', [UtilisateurController::class, 'destroy'])->name('utilisateurs.destroy');
    Route::get('/{id}/toggle', [UtilisateurController::class, 'toggleActif'])->name('utilisateurs.toggle');
});