<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/pages', [PageController::class, 'index']);

Route::get('/', function () {
    return "ok";
});