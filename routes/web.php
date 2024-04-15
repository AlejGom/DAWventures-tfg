<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutesController;

Route::get('/', function () {
    return view('main');
});

Route::get('/main', [RoutesController::class, 'showMainForm'])->name('main');

Route::get('/login', [RoutesController::class, 'showLoginForm'])->name('login');

Route::get('/signup', [RoutesController::class, 'showSignupForm'])->name('signup');