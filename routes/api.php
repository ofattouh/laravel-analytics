<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API endpoint controller:PostController
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Add API endpoint route:posts to fetch DB posts using Vue fetchPosts() axios request call to: `/api/posts`
Route::get('posts', [PostController::class, 'index']);


/*
    Because some routes will be for API, add them to routes/api.php so Laravel automatically add api/ prefix to
    routes but only after running this artisan command to install these api routes: `php artisan install:api`               // Prepare Laravel application for API routes


    https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/load-data-from-api-axios
*/
