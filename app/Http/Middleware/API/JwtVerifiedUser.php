<?php

namespace App\Http\Middleware\API;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class JwtVerifiedUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth('api')->check()) {
            return jsonresUnauthorized([]);
        }

        $user = auth('api')->user();

        if ($user->isEmptyVerified()) {
            return jsonresUnauthorized([]);
        }

        return $next($request);
    }
}
