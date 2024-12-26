<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckLink;

Route::get('/register', [PublicController::class, 'index']);
Route::post('/register', [PublicController::class, 'register'])
    ->name('register')
;
Route::get('/link/{username}/{link}', [PublicController::class, 'showLink'])
    ->name('link')
;

Route::get('/{link?}', [MainController::class, 'index'])
    ->middleware(CheckLink::class)
;

// add link here, apply middleware to all MainCtrl routes
Route::get('/getlucky/{link}', [MainController::class, 'getLucky']);
