<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        // Set header:`Accept:application/json` to display 404 api error as JSON instead of HTML 404 error page
        // $middleware->prepend(\App\Http\Middleware\AlwaysAcceptJson::class);
        $middleware->prependToGroup('api', \App\Http\Middleware\AlwaysAcceptJson::class);

        // Add related Cors Middleware if needed
        // $middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Check error message exception key to find which Exception to use from `/api` calls output in Postman
        // For security reasons, hide Laravel default error message senstive info in production
        $exceptions->renderable(function (NotFoundHttpException $e) {
            // Laravel config directory is accessed as facade:`config('app.debug')` or class:`Config::get('app.debug')`
            if (!config('app.debug')) {
                return response()->json(['message' => '404: Object not found'], 404);
            }
        });
    })->create();

/*

    The prefix `api` is set as a default value for $apiPrefix parameter

    Laravel default `/api` calls 404 error message: {
        "message": "No query results for model [App\\Models\\Category] 1",
        "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
        ...
    }

    use Illuminate\Http\Request;

    // Prevent web users from viewing `/api` custom 404 error message instead of default HTML 404 error page
    // by adding check for web application app
    $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
        if ($request->isFromWebVueApp()) {
            return response()->json(['message' => 'Object not found'], 404);
        }
    });

    return response()->json(['message' => env('APP_DEBUG')? $e->getMessage() : 'Object not found'], 404);

    // https://laravel.com/docs/12.x/sanctum

*/
