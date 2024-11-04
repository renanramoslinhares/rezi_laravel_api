<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/pages', [PageController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return "ok";
});