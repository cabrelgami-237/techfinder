<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\UserCompetenceController;

// ✅ search AVANT resource
Route::get('competences/search', [CompetenceController::class, 'search']);

// ✅ autres routes
Route::apiResource('utilisateurs', UtilisateurController::class);
Route::apiResource('usercompetences', UserCompetenceController::class);
