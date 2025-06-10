<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Authetication routes

// Using route group instead of defining individual routes,add methods on Route facade: middleware, then use
// group method with closure and add all routes protected with middleware: `auth` inside this closure
Route::middleware('auth')->group(function () {

    // Added by Breeze Laravel package
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Using HTML Hyperlink instead of `router-link`
    Route::get('/posts/index', function () {
        return view('posts-listings');
    });

    // Using HTML Hyperlink instead of `router-link`
    Route::get('/posts/index2', function () {
        return view('posts-listings-2');
    });

    // Using HTML Hyperlink instead of `router-link`
    Route::get('/posts/create', function () {
        return view('post-create');
    });

    // Using HTML Hyperlink instead of `router-link`
    Route::get('/posts/edit/{id}', function (string $id) {
        return view('post-edit');
    })->where('id', '[0-9]+');

    // Fetch DB products from route:`/products/list` using endpoint:`/api/products` in composables/products.js
    Route::get('/products/list', [\App\Http\Controllers\Api\ProductController::class, 'list']);

    // Using HTML Hyperlink instead of `router-link`
    Route::get('/user/dashboard', function () {
        return view('my-user-dashboard');
    })->name('user.dashboard');

    // Method middleware, with auth as parameter: only authenticated logged-in users can access this view
     Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Logout user when button in AppNavigation.vue is clicked using Laravel Breeze package
    Route::post('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']);

    // Get logged in user info in AppNavigation.vue using Laravel Backend
    Route::get('user-info', [\App\Http\Controllers\MyUserController::class, 'getUserInfo']);

    // Get logged in user role in Index2.vue using Laravel Backend
    Route::get('user-role', ['uses' => '\App\Http\Controllers\ProfileController@getUserRolePermissions', 'request' => null]);

    // Redirect route:dashboard to another custom route
    Route::get('/dashboard', function () {
        return redirect('/user/dashboard');
    });

});

// Route executed when no other route matches requests instead of showing Laravel default "404" page for unhandled requests
Route::fallback(function () {
    return view('not-found-404');
});

// Auth routes file define all routes required for authentication: login, registration, logout and forgot password (Laravel Breeze package)
require __DIR__.'/auth.php';

/*
    Middleware runs checks before Routes, and if it returns false, it shows errors or redirect to error page.
    Example: Using auth middleware, if users want to visit the /dashboard URL, protected with auth Middleware,
    they will automatically get redirected to login URL defined in Laravel Breeze Login redirect method

    We should assign category resource route to auth Middleware to protect it. We could add middleware() method to
    each Route and provide Middleware, or if Route has multiple Middlewares provide them as array using Route group instead

    Route names should always be unique

    Route::view('/', 'dashboard')->name('dashboard');

    // Restrict access to categories route to admin user using 2 Options:
    // Option 1: Apply Middleware:IsAdminMiddleware by passing Middleware class name
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware(\App\Http\Middleware\IsAdminMiddleware::class);

    // Option 2: Apply Middleware:IsAdminMiddleware by passing alias:is_admin
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('is_admin');

    Route::middleware('auth')->group(function () {
        // Point any route to dashboard view so they are loaded inside Vue HTML main layout root component
        Route::view('/{any?}', 'dashboard')->where('any', '.*');

        // Point /posts/* route to dashboard view so they are loaded inside Vue HTML main layout root component
        Route::get('/posts/{any?}', function () {
            return view('dashboard');
        })->name('dashboard')->where('any', '.*');

        // Point /posts/{whereIn} route to dashboard view so they are loaded inside Vue HTML main layout root component
        Route::get('/posts/{post}', function (string $post) {
            return view('dashboard');
        })->name('dashboard')->whereIn('post', ['create', 'index', 'index2']);

        // Optional route parameter `name ` by adding question mark with default value of null
        Route::get('/user/{name?}', function (?string $name = null) {
            return $name;
        });

        // Resource route name: categories used inside View files:create/edit/index of directory categories where
        // each route method is constructed from route name dot controller method name (Ex:categories.index).
        // Restrict access to categories and posts routes to admin user
        Route::middleware('is_admin')->group(function () {
            Route::resource('categories', \App\Http\Controllers\CategoryController::class);
            Route::resource('posts', \App\Http\Controllers\PostController::class);
        });
    });

    Route::view('/welcome', 'welcome', ['name' => 'foo']);
    Route::get('about-us', ['uses'=>'MyController@about_us','name'=>'foo','page'=>'about'])->name('about-us');

    Route::get('campaign/showtakeup/{id}', ['uses' =>'campaignController@showtakeup'])->name('showtakeup');
    Route::get('groups/(:any)', array('as' => 'group', 'uses' => 'groups@show'));


    // IMPORTANT
    Had to change navigation links from `router-link` to hyperlinks because `vue-router` routing conflicts with
    Laravel routes/web.php routing,and router.push() no longer redirects to other routes because of this change

    Could of used `vue-router` for front-end routing but it conflicts with web.php Laravel back-end routing

    https://laravel.com/docs/12.x/routing
    https://laravel.com/docs/12.x/responses
    https://laravel.com/docs/12.x/authentication

*/
