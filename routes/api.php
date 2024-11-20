<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('{project_key}/api')->group(function ($project_key) {
    Route::get('/', function (Request $request, $project_key) {
        return 'hello ' . $project_key; // não estou copnseguindo chegar aqui
    });

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/pages', [PageController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/pages', [PageController::class, 'store']);
    Route::middleware('auth:sanctum')->put('/pages/{id}', [PageController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/pages/{id}', [PageController::class, 'destroy']);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/users', [UserController::class, 'store']);
    Route::middleware('auth:sanctum')->put('/users/{id}', [UserController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/users/{id}', [UserController::class, 'destroy']);
});
