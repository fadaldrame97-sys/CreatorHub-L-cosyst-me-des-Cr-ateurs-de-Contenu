<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\CandidatureController;


Route::get('/test', [TestController::class, 'index']);
Route::get('/offres', [OfferController::class, 'index']);

Route::apiResource('offres', OfferController::class);
Route::apiResource('candidatures', CandidatureController::class);