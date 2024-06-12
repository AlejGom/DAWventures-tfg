<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExperiencesController;
use App\Models\Experience;

Route::get('/', function () {
    $experiences = Experience::orderBy('created_at', 'desc')->get();
    return view('main', [
        'experiences' => $experiences
    ]);
});

Route::get('/main', [RoutesController::class, 'showMainForm'])->name('main');

Route::get('/login', [RoutesController::class, 'showLoginForm'])->name('showLogin');
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::get('/signup', [RoutesController::class, 'showSignupForm'])->name('showSignup');
Route::post('/signup', [UsersController::class, 'signup'])->name('signup');

Route::get('/logout', [UsersController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/upload', [RoutesController::class, 'showUploadForm'])->name('showUpload')->middleware('auth');
Route::post('/upload', [ExperiencesController::class, 'upload'])->name('upload');

Route::get('/profile', [RoutesController::class, 'showProfile'])->name('showProfile')->middleware('auth');
Route::post('/profile', [UsersController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');

Route::get('/experience/{id}', [RoutesController::class, 'showExperience'])->name('showExperience');

Route::get('/deleteExperience/{id}', [ExperiencesController::class, 'deleteExperience'])->name('deleteExperience')->middleware('auth');

Route::get('/editExperience/{id}', [RoutesController::class, 'showEditForm'])->name('showEditForm')->middleware('auth');
Route::post('/editExperience/{id}', [ExperiencesController::class, 'update'])->name('update')->middleware('auth');

Route::get('/showOtherUser/{id}', [RoutesController::class, 'showOtherUser'])->name('showOtherUser');