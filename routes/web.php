<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [PublicController::class, 'index']);
Route::post('/register', [PublicController::class, 'register']);
