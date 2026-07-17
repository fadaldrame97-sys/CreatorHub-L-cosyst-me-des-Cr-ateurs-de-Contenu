<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RealisationController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\SaveController;

// Feed
Route::get('/feed', [RealisationController::class, 'index']);

// Publication
Route::post('/realisations', [RealisationController::class, 'store']);

// Recherche
Route::get('/search', [RealisationController::class, 'search']);

// Like
Route::post('/realisations/{realisation}/like', [LikeController::class, 'store']);
Route::delete('/realisations/{realisation}/like', [LikeController::class, 'destroy']);

// Save (Bookmark)
Route::post('/realisations/{realisation}/save', [SaveController::class, 'store']);
Route::delete('/realisations/{realisation}/save', [SaveController::class, 'destroy']);
