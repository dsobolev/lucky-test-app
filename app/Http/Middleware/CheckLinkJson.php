<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CheckLinkJson
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $linkParam = $request->route('link');

        $user = User::where('link_token', $linkParam)->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Link not found'], 404);
        }

        if ($user->expired_at <= now()) {
            return response()->json(['message' => 'Link expired'], 419);
        }

        return $next($request);
    }
}
