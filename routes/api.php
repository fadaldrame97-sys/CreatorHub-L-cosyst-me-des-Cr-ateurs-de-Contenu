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



Route::apiResource('offres', OfferController::class);
Route::apiResource('candidatures', CandidatureController::class);
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\RealisationController;
use App\Http\Controllers\Api\SaveController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SkillController;

Route::get('/feed',[FeedController::class,'index']);
Route::get('/feed/{realisation}',[FeedController::class,'show']);

Route::get('/search',[SearchController::class,'search']);
Route::get('/filter/skills',[SearchController::class,'filterBySkill']);
Route::get('/filter/price',[SearchController::class,'filterByPrice']);
Route::get('/creators',[SearchController::class,'creators']);

Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('realisations',RealisationController::class);

    Route::get('/my-realisations',
        [RealisationController::class,'myPortfolio']);

    Route::post('/realisations/{realisation}/like',
        [LikeController::class,'toggle']);

    Route::get('/my-likes',
        [LikeController::class,'index']);

    Route::post('/realisations/{realisation}/save',
        [SaveController::class,'toggle']);

    Route::get('/my-saves',
        [SaveController::class,'index']);

});


Route::apiResource('skills',SkillController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/test', [TestController::class, 'index']);
    Route::get('/offres', [OfferController::class, 'index']);

    Route::apiResource('offres', OfferController::class);
    Route::apiResource('candidatures', CandidatureController::class);


});
