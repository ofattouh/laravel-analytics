<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API endpoint controller:PostController
use App\Http\Controllers\Api\PostController;

// API endpoint controller:CategoryController
use App\Http\Controllers\Api\CategoryController;

// API authetication for group of routes using middleware:`auth:sanctum` which use Bearer Tokens for 3rd party
// apps authetication as fallback but instead is using sessions of guard:`web` from 'config/sanctum.php'
Route::group(['middleware' => 'auth:sanctum'], function() {

    // API endpoint for ALL routes of posts using apiResource for ALL RESTful methods of controller:PostController
    Route::apiResource('posts', PostController::class); // references controller:Api:PostController

    // API endpoint for route:categories to fetch DB categories from `/api/categories`
    Route::get('categories', [CategoryController::class, 'index']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


/*
    Because some routes will be for API, add them to routes/api.php so that Laravel automatically add /api prefix
    to api routes but only after running this artisan command to install api routes: `php artisan install:api`               // Prepare Laravel application for API routes

    No additional RESTful routes are needed for methods of Controller:PostController, because ALL routes
    are defined in Route::apiResource()

    // IMPORTANT
    Authentication routes in routes/api.php fallback is to use API Bearer Token for authentication while extra
    configuration is needed for API routes to support session storage unlike routes/web.php default support
    for sessions of `web` and without this,routes/api.php can NOT store user data in session and Auth::user()
    returns null UNLESS you set SANCTUM_STATEFUL_DOMAINS in config/sanctum.php or .env and using guard:'auth:sanctum'
    to log Vue/SPA using sessions of guard:`web`,explained here: https://stackoverflow.com/a/44863089/13729121

    // Individual route
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    // API endpoint for route:posts used in `/posts` with GET method
    Route::get('posts', [PostController::class, 'index']);  // references controller:PostController


    // Define abilities based on call to /abilities API endpoint using API route:abilities
    // Get authenticated user roles with permissions, pluck to have only permissions, and using other
    // collection methods, get the unique permissions in the array list
    // Use this API call in auth.js Composable, using method getAbilities()
    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });

    https://laraveldaily.com/lesson/vue-laravel-vite-spa-crud/load-data-from-api-axios
    https://stackoverflow.com/questions/62354802/laravel-7-x-sanctum-spa-with-vuejs-always-returns-401-unauthorized
    https://laravel.com/docs/12.x/sanctum

*/
