<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use Illuminate\Http\Request;


Route::post('/login', [AuthController::class, 'login']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}', [ArticleController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
});
