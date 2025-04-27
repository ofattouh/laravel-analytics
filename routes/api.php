<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API endpoint controller:PostController
use App\Http\Controllers\Api\PostController;

// API endpoint controller:CategoryController
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API endpoint for route:posts to fetch DB posts from `/api/posts`
Route::get('posts', [PostController::class, 'index']);

// API endpoint for route:categories to fetch DB categories from:`/api/categories`
Route::get('categories', [CategoryController::class, 'index']);


/*
    Because some routes will be for API, add them to routes/api.php so that Laravel automatically add api/ prefix
    to routes but only after running this artisan command to install api routes: `php artisan install:api`               // Prepare Laravel application for API routes


    https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/load-data-from-api-axios
*/
