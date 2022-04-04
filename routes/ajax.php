<?php

use App\Http\Controllers\Backend\Ajax as BackendAjaxNamespace;

Route::group(['prefix' => 'ajax', ], function () {
    Route::group(['prefix' => 'uploads'], function(){
        Route::post('image-upload', [BackendAjaxNamespace\ImageUploadAjaxController::class, 'imageUpload'])->name('ajax.uploads.image-upload');
    });
});
