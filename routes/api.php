<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\xAPIPostController;

// xAPI routes for SCORM Cloud Prototypes Packages: https://xapi.com/download-prototypes/
Route::controller(xAPIPostController::class)->group(function () {
    Route::get('/xapiposts', 'index');
    Route::get('/xapiposts/activities/profile{any?}', 'index');
    Route::post('/xapiposts/activities', 'store');

    Route::get('/xapiposts/activities/state', 'index');
    Route::post('/xapiposts/activities/state', 'store');

    Route::get('/xapiposts/statements{any?}', 'index');
    Route::put('/xapiposts/statements', 'edit');
    Route::post('/xapiposts/statements', 'store');

    // http://local-2.evaluation.pshsa.ca:8000/api/xapiposts/activities/profile?profileId=highscores&activityId=http%3A%2F%2Fid.tincanapi.com%2Factivity%2Ftincan-prototypes%2Ftetris
    // http://local-2.evaluation.pshsa.ca:8000/api/xapiposts/statements?limit=25&related_activities=false&related_agents=false
});

// API endpoint for route:products to fetch DB products from `/api/products`
Route::get('products', [ProductController::class, 'index']);

// API authentication for group of routes using middleware:`auth:sanctum` which use Bearer Tokens for 3rd party
// apps authentication as fallback but instead is using sessions of guard:`web` from 'config/sanctum.php'
Route::group(['middleware' => 'auth:sanctum'], function() {

    // API endpoint for ALL routes of posts using apiResource for ALL RESTful methods of controller:PostController
    Route::apiResource('posts', PostController::class); // references controller:Api:PostController

    // API endpoint for route:categories to fetch DB categories from `/api/categories`
    Route::get('categories', [CategoryController::class, 'index']);

    // API endpoint for route:categories/{category} to fetch DB category from `/api/categories/{categoryId}`
    Route::get('categories/{category}', [CategoryController::class, 'show']);

    // API endpoint for route:lists/categories to fetch DB categories from `/api/lists/categories/`
    Route::get('lists/categories', [CategoryController::class, 'list']);

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

    // Individual route
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware(Authenticate::using('sanctum'));

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
