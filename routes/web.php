<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MainController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/register', 'index');
    Route::post('/register', 'register')
        ->name('register')
    ;
    Route::get('/link/{username}/{link}', 'showLink')
        ->name('link')
    ;
});

Route::controller(MainController::class)->group(function () {
    Route::get('/{link?}', 'index');
    Route::post('/{link}', 'regenerate');
    Route::delete('/{link}', 'deactivate');

    Route::get('/getlucky/{link}', 'getLucky');

    Route::get('/history/{link}', 'history');
});
