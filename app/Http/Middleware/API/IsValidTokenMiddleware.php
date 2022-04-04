<?php

namespace App\Http\Middleware\API;

use App\Helpers\ResponseHelper;
use Closure;

class IsValidTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $parsedToken = \JWTAuth::parseToken();
            if($parsedToken->authenticate()){
                $iat = \Carbon\Carbon::createFromTimestamp($parsedToken->getPayload()->get('iat'));
                $isValid = (auth()->user()->isTokenValid([
                    'iat_time' => $iat->toDateTimeString()
                ]));
                if(!$isValid){
                    $parsedToken->invalidate();
                    return response()->json([
                        'status' => false,
                        'data' => null,
                        'message' => 'Provided token is invalid',
                        'status_code' => ResponseHelper::STATUS_CODE_FOR_UNAUTHORIZED
                    ],ResponseHelper::STATUS_CODE_FOR_UNAUTHORIZED);
                }
            }else{
                return $next($request);
            }
        }catch (\Exception $exception){
            return $next($request);
        }

        return $next($request);
    }
}
