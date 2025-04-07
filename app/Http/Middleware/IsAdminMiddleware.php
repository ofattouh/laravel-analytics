<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Show permission error for guest logged in user
        if (! auth()->user()->is_admin) {
            abort(403);
        }

        // OR proceed with next request if no issues
        return $next($request);
    }
}

/*
    handle(), returns next request. Before the return method, add conditions the application needs and abort
    next request if needed

    Inside Middleware, if is_admin field in User table is false, abort with forbidden status. To obtain
    currently authenticated user, use Laravel helper method:auth()->user() and then call is_admin field

    Next, we must register Middleware to use it as an alias. Middleware is registered in bootstrap/app.php file.
    Then, we can use is_admin Middleware in web.php routes, however because we need to restrict access only to
    category routes, is_admin Middleware needs to be used only on that route instead of Route group

    https://laraveldaily.com/lesson/laravel-beginners/middleware-route-groups-auth
*/
