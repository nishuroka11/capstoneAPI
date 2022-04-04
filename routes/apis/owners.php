<?php

use App\Helpers\MiddlewareHelper;
use App\Http\Controllers\API as APINamespace;

Route::group([
    'prefix' => 'owners',
    'middleware' => [MiddlewareHelper::NAME_FOR_LOGGED_IN_USER, MiddlewareHelper::NAME_FOR_IS_VALID_TOKEN, MiddlewareHelper::NAME_FOR_IS_USER_TYPE_OWNER]
], function () {

    Route::group(['prefix' => 'animals'], function () {

        $animalOwnerApiController = APINamespace\Animals\AnimalOwnerAPIController::class;

        Route::get('/', [$animalOwnerApiController, 'index']);

        Route::post('/', [$animalOwnerApiController, 'store']);

        Route::post('/{id}/update', [$animalOwnerApiController, 'update']);

        Route::post('/{id}/delete', [$animalOwnerApiController, 'delete']);
    });

    Route::group(['prefix' => 'notices'], function(){

        $noticeOwnerApiController = APINamespace\Notices\NoticeOwnerAPIController::class;

        Route::get('/', [$noticeOwnerApiController, 'index']);

        Route::post('/', [$noticeOwnerApiController, 'store']);
    });
});
