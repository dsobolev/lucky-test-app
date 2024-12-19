<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
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

        $user = User::where('link_token', $linkParam)->first();

        if (is_null($user)) {
            return to_route('register');
        }

        if ($user->expired_at <= now()) {
            return to_route('register');
        }

        return $next($request);
    }
}
