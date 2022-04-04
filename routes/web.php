<?php

use App\Http\Controllers\Backend as BackendNamespace;
use App\Http\Controllers\Frontend as FrontendNamespace;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/password-reset-successful', function () {
    return view('auth.password-changed');
});

Route::get('/', [FrontendNamespace\FrontendController::class, 'index'])->name('frontend.index');

Route::group(['middleware' => ['auth', 'verified', 'strip-empty-params']], function () {
//    dd('here');

    //Only Authenticated user
    Route::group(['as' => 'backend.', 'prefix' => 'backend', 'middleware' => [\App\Helpers\MiddlewareHelper::NAME_FOR_AUTHENTICATED_ROLE]], function () {
        Route::get('morningstar/info/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
        Route::get('morningstar/audit/logs', [BackendNamespace\AuditController::class, 'index'])->name('morningstar.audit.logs');

        Route::get('/dashboards', [BackendNamespace\DashboardController::class, 'index'])->name('dashboards.index');
        Route::get('/', [BackendNamespace\DashboardController::class, 'index'])->name('dashboards.index');

        Route::resource('users', BackendNamespace\UserController::class);

        Route::get('permissions/bulk-store', [BackendNamespace\PermissionController::class, 'bulkStoreCreate'])->name('permissions.bulk-store.create');

        Route::post('permissions/bulk-store', [BackendNamespace\PermissionController::class, 'bulkStore'])->name('permissions.bulk-store.store');

        Route::resource('permissions', BackendNamespace\PermissionController::class);

        Route::resource('roles', BackendNamespace\RoleController::class);

        Route::resource('page-posts', BackendNamespace\PagePostController::class);

        include 'ajax.php';

        include 'patches.php';
    });
});

Route::get('esewa', function(){
   return view('test.esewa');
});

Route::get('esewa-testing', [\App\Http\Controllers\Test\TestController::class, 'index']);
