<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authetication routes

// OR Method 2 using Route group where we add methods on Route facade: middleware, prefix, etc., then use
// group method with closure and add all Routes protected with middleware: `auth` inside this closure
Route::middleware('auth')->group(function () {

    // Added by Breeze Laravel package
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Added by Breeze Laravel package
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource route name: categories used inside View files:create/edit/index of directory categories where
    // each route method is constructed from route name dot controller method name (Ex:categories.index).
    // Restrict access to categories and posts routes to admin user
    Route::middleware('is_admin')->group(function () {
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
        Route::resource('posts', \App\Http\Controllers\PostController::class);
    });


});

// Auth routes file define all routes required for authentication: login, registration, logout and forgot password
require __DIR__.'/auth.php';

/*
    Middleware runs checks before Routes, and if it returns false, it shows errors or redirect to error page.
    Example: Using auth middleware, if someone wants to visit the /dashboard URL, protected with auth Middleware,
    they will automatically get redirected to login page

    We should assign category resource route to auth Middleware to protect it. We could add middleware() method to
    Route and provide Middleware, or if Route has multiple Middlewares provide them as array. Use Route group instead

    // Method 1: Method middleware, with auth as parameter: only authenticated logged-in users can access this view
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Restrict access to categories route to admin user using 2 Options:
    Option 1: Apply Middleware:IsAdminMiddleware by passing Middleware class name
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(\App\Http\Middleware\IsAdminMiddleware::class);

    Option 2: Apply Middleware:IsAdminMiddleware by passing alias:is_admin
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('is_admin');

*/
