<?php

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\API as APINamespace;
use App\Library\AppConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if (AppConfig::generic()->shouldApiAccess()) {
    Route::group(['namespace' => 'API', 'middleware' => [MiddlewareHelper::NAME_FOR_IS_VALID_TOKEN]], function () {

        if (AppConfig::generic()->shouldSocialLogin()) {
            Route::post('social-login/google', [APINamespace\SocialLoginAPIController::class, 'google']);

            Route::post('social-login/facebook', [APINamespace\SocialLoginAPIController::class, 'facebook']);
        }
        Route::get('users/send-email-verification-code', [APINamespace\UserVerificationAPIController::class, 'getEmailVerificationCode']);

        Route::post('users/send-email-verification-code', [APINamespace\UserVerificationAPIController::class, 'postEmailVerificationCode']);

        Route::post('users/add-email-address', [APINamespace\UserAPIController::class, 'addEmailAddress']);

        Route::post('users/register', [APINamespace\UserAPIController::class, 'store']);

        Route::post('users/login', [APINamespace\UserAPIController::class, 'login']);

        Route::post('users/me', [APINamespace\UserAPIController::class, 'me']);

        Route::post('users/edit-profile', [APINamespace\UserAPIController::class, 'editProfile']);

        Route::post('users/logout', [APINamespace\UserAPIController::class, 'logout']);

        Route::post('users/forget-password', [APINamespace\UserForgetPasswordAPIController::class, 'postForgetPassword']);

        Route::post('users/change-password', [APINamespace\UserChangePasswordAPIController::class, 'changePassword']);

        Route::get('page-posts/{slug}', [APINamespace\PagePostAPIController::class, 'getPagePost']);

    });

    require 'apis/owners.php';
}
