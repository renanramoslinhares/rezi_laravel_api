<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return "ok";
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/pages', [PageController::class, 'index']);
Route::middleware('auth:sanctum')->post('/pages', [PageController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/users', [UserController::class, 'store']);

