<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Resource route name: categories used inside each View file Hyperlink where route method is constructed from:
// route name dot controller method name. Example: categories.index
Route::resource('categories', \App\Http\Controllers\CategoryController::class);


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
