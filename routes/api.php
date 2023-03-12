<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('auth')->group(function (){
    Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('article', ArticleController::class)->except(['index', 'show']);
    Route::apiResource('comment', CommentController::class)->except('store');
    Route::post('comment/{article}', [CommentController::class, 'store']);
});
Route::apiResource('article', ArticleController::class)->only(['index', 'show']);

