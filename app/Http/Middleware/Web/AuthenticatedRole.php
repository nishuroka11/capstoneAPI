<?php

namespace App\Http\Middleware\Web;

use App\Models\Role;
use App\Modules\Roles\Constants\RoleConstant;
use Closure;

use Illuminate\Http\Request;

class AuthenticatedRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403);
        }

        if(auth()->user()->isSuperAdministrator()){
            return $next($request);
        }

        if (!empty(auth()->user()->mainRole()) && !auth()->user()->mainRole()->canAccessWeb()) {
            auth()->logout();
            return redirect()->intended('/');
        }

        return $next($request);
    }

}
