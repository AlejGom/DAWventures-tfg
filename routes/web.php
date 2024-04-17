<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('main');
});

Route::get('/main', [RoutesController::class, 'showMainForm'])->name('main');

Route::get('/login', [RoutesController::class, 'showLoginForm'])->name('showLogin');
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::get('/signup', [RoutesController::class, 'showSignupForm'])->name('showSignup');
Route::post('/signup', [UsersController::class, 'signup'])->name('signup');

Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/upload', [RoutesController::class, 'showUploadForm'])->name('showUpload');

Route::get('/profile', [RoutesController::class, 'showProfile'])->name('showProfile');