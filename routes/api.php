<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkSpaceController;
use App\Http\Controllers\WorkSpaceUserController;

Route::get('/test', [TestController::class, 'index']);
Route::apiResource("workspaces",WorkSpaceController::class);
Route::apiResource("workspaceusers",WorkSpaceUserController::class);
Route::apiResource("tsks",TaskController::class);
Route::put("/task/{id}/assign",[TaskController::class,"assigneTask"]);
Route::put("/task/{id}/valideTask",[TaskController::class,"validateTask"]);
Route::put("/task/{id}/invalideTask",[TaskController::class,"invalidateTask"]);

use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\CandidatureController;





Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/test', [TestController::class, 'index']);
    Route::get('/offres', [OfferController::class, 'index']);

    Route::apiResource('offres', OfferController::class);
    Route::apiResource('candidatures', CandidatureController::class);

 
});
