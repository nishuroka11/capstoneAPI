<?php

namespace App\Http\Middleware\API;

use App\Helpers\ResponseHelper;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = \JWTAuth::parseToken()->authenticate();
            if (empty($user)) {
                return jsonresUnauthorized();
            }
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return jsonresUnauthorized();
            } else if ($e instanceof TokenExpiredException) {
                return jsonresUnauthorized();
            } else {
                return jsonresUnauthorized();
            }
        }
        return $next($request);
    }
}
