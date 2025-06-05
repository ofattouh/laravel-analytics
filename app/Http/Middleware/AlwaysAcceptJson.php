<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlwaysAcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set header:`Accept:application/json` to display info/errors as JSON instead of showing HTML 404 page
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}

/*

    Inside this Middleware, we set the header of the request and pass it to next request

    Middleware can also be used for preventing access to Backend resources by using Laravel

    Middleware can be registered to every Route or prepended to a group such as `web` or `api` and it must be
    defined in bootstrap/app.php

    When working with any API, it is very important to set the headers of request

*/
