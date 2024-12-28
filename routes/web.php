<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MainController;

Route::get('/register', [PublicController::class, 'index']);
Route::post('/register', [PublicController::class, 'register'])
    ->name('register')
;
Route::get('/link/{username}/{link}', [PublicController::class, 'showLink'])
    ->name('link')
;


Route::get('/{link?}', [MainController::class, 'index']);
Route::post('/{link}', [MainController::class, 'regenerate']);
Route::delete('/{link}', [MainController::class, 'deactivate']);

// add link here, apply middleware to all MainCtrl routes
Route::get('/getlucky/{link}', [MainController::class, 'getLucky']);

Route::get('/history/{link}', [MainController::class, 'history']);
