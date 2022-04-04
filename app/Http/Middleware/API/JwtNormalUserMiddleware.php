<?php

namespace App\Http\Middleware\API;

use App\Helpers\ResponseHelper;
use App\Models\Role;
use App\Modules\Roles\Constants\RoleConstant;
use Closure;
use Illuminate\Http\Request;

class JwtNormalUserMiddleware
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

        if (!$user->hasRole(RoleConstant::ROLE_NAME_FOR_NORMAL_USER)) {
            return jsonresUnauthorized();
        }

        return $next($request);
    }
}
