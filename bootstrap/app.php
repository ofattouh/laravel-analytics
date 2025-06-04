<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Add API endpoint route by running: `php artisan install:api`
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register Middleware:IsAdminMiddleware and create alias:is_admin
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdminMiddleware::class,
        ]);

        // Allow incoming requests from Vue/SPA to authenticate using Laravel web session cookies while still
        // allowing requests from third parties or mobile applications to authenticate using API tokens
        // Using middleware:`auth:sanctum`, routes/api.php can use routes/web.php stateful sessions (Bearer Token not used)
        $middleware->statefulApi();

        // Add related Cors Middleware if needed
        // $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

/*

    The prefix `api` is set as a default value for $apiPrefix parameter

    // https://laravel.com/docs/12.x/sanctum

*/
