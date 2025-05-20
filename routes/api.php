<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API endpoint controller:PostController
use App\Http\Controllers\Api\PostController;

// API endpoint controller:CategoryController
use App\Http\Controllers\Api\CategoryController;

// API authetication middleware:`sanctum` using API tokens instead of sessions of middleware:`web`
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API endpoint for ALL routes of posts using apiResource for ALL RESTful methods of controller:PostController
Route::apiResource('posts', PostController::class);  // references controller:Api:PostController

// API endpoint for route:categories to fetch DB categories from `/api/categories`
Route::get('categories', [CategoryController::class, 'index']);


/*
    Because some routes will be for API, add them to routes/api.php so that Laravel automatically add /api prefix
    to api routes but only after running this artisan command to install api routes: `php artisan install:api`               // Prepare Laravel application for API routes

    No additional RESTful routes are needed for methods of Controller:PostController, because ALL routes
    are defined in Route::apiResource()

    IMPORTANT:
    Authentication routes in routes/api.php use API token for authentication and API routes do NOT support
    session storage unlike routes/web.php with middleware `web` so routes/api.php can NOT store user data in
    session and Auth::user() always returns null,as explained here: https://stackoverflow.com/a/44863089/13729121

    // API endpoint for route:posts used in `/api/posts` with GET method
    Route::get('posts', [PostController::class, 'index']);  // references controller:Api:PostController


    https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/load-data-from-api-axios
*/
