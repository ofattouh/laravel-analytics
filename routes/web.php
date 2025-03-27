<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// All routes below are added by Laravel Breeze package

// Method middleware, with auth as parameter: only authenticated logged-in users can access this view/page
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes file define all routes required for authentication: login, registration, logout and forgot password
require __DIR__.'/auth.php';


/*

    // https://laraveldaily.com/lesson/laravel-beginners/login-register-breeze

*/
