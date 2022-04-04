<?php

namespace App\Http;

use App\Helpers\MiddlewareHelper;
use App\Http\Middleware\API\IsUserTypeOwner;
use App\Http\Middleware\API\IsValidTokenMiddleware;
use App\Http\Middleware\HttpsProtocolMiddleware;
use App\Http\Middleware\StripEmptyParams;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        HttpsProtocolMiddleware::class

    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        //Custom
        'strip-empty-params' => StripEmptyParams::class,
        MiddlewareHelper::NAME_FOR_LOGGED_IN_USER => \App\Http\Middleware\API\JwtMiddleware::class,
        MiddlewareHelper::NAME_FOR_OPTIONAL_LOGGED_IN_USER => \App\Http\Middleware\API\JwtOptionalLoginMiddleware::class,
        MiddlewareHelper::NAME_FOR_NORMAL_USER_ROLE => \App\Http\Middleware\API\JwtNormalUserMiddleware::class,

        MiddlewareHelper::NAME_FOR_VERIFIED_USER => \App\Http\Middleware\API\JwtVerifiedUser::class,
        MiddlewareHelper::NAME_FOR_NON_VERIFIED_USER => \App\Http\Middleware\API\JwtNonVerifiedUser::class,
        MiddlewareHelper::NAME_FOR_AUTHENTICATED_ROLE => \App\Http\Middleware\Web\AuthenticatedRole::class,

        MiddlewareHelper::NAME_FOR_IS_VALID_TOKEN => IsValidTokenMiddleware::class,
        MiddlewareHelper::NAME_FOR_IS_USER_TYPE_OWNER => IsUserTypeOwner::class,

    ];
}
