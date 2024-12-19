<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLink
{
    public function handle(Request $request, Closure $next): Response
    {
        $linkParam = $request->route('link');
        if (is_null($linkParam)) {
            return to_route('register');
        }

        // check if it is in DB
        // check // expiration -> migration

        return $next($request);
    }
}
