<?php

namespace App\Http\Middleware\API;

use App\Helpers\ResponseHelper;
use Closure;

class JwtOptionalLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $token = \JWTAuth::getToken();

        /*if (empty($token)) {
            return $next($request);
        }*/
        try {
            $user = \JWTAuth::parseToken()->authenticate();

            if (empty($user)) {
                return jsonresUnauthorized();
            }
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return jsonresUnauthorized();
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return jsonresUnauthorized();
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                return $next($request);
            } else {
                return jsonresUnauthorized();
            }
        }
        return $next($request);
    }
}
