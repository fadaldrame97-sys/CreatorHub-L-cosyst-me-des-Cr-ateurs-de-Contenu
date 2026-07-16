<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\OfferController;

Route::get('/test', [TestController::class, 'index']);
Route::get('/offres', [OfferController::class, 'index']);