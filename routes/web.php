<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealisationController;

Route::get('/feed', [RealisationController::class, 'index'])
    ->name('feed');

Route::get('/realisations/create', [RealisationController::class, 'create'])->name('realisations.create');

Route::post('/realisations', [RealisationController::class, 'store'])->name('realisations.store');

// Route::get('/', function () {
//     return view('welcome');
// });

