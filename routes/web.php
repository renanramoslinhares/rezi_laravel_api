<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/documentation');
});

Route::prefix('/{project_key}')->group(function ($project_key) {
    Route::get('/', function (Request $request, $project_key) {
        return $project_key;
    });

    Route::get('/page', function (Request $request) {
        return 'PAGE';
    });

    Route::get('/{page_key}', function (Request $request, $page_key) {
        return $page_key;
    });
});