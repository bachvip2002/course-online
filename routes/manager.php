<?php

use App\Http\Controllers\Manager\AuthenticationController;
use App\Http\Controllers\Manager\DashboardController;
use App\Http\Controllers\Manager\ResourceManagementController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Middleware\ManagerAuthenticate;
use Illuminate\Support\Facades\Route;

//user begin
Route::get('manager/authentication/sign-in-page', [AuthenticationController::class, 'renderSignInPage'])
    ->name('manager.authentication.sign-in-page');

Route::post('manager/authentication/login', [AuthenticationController::class, 'login'])
    ->name('manager.authentication.login');

Route::get('manager/authentication/logout', [AuthenticationController::class, 'logout'])
    ->name('manager.authentication.logout');

Route::prefix('manager')
    ->name('manager.')
    ->middleware([ManagerAuthenticate::class])
    ->group(
        function () {
            Route::get('dashboard.index', [DashboardController::class, 'index'])
                ->name('dashboard.index');

            Route::get('user/list-page', [UserController::class, 'renderListPage'])
                ->name('user.list-page');

            Route::get('user/create-page', [UserController::class, 'renderCreatePage'])
                ->name('user.create-page');

            Route::get('user/edit-page', [UserController::class, 'renderEditPage'])
                ->name('user.edit-page');

            Route::get('user/detail-page', [UserController::class, 'renderDetailPage'])
                ->name('user.detail-page');

            Route::post('user/store', [UserController::class, 'store'])
                ->name('user.store');

            Route::put('user/update', [UserController::class, 'update'])
                ->name('user.update');

            Route::delete('user/delete', [UserController::class, 'delete'])
                ->name('user.delete');

            Route::get('resource-management/list-page', [ResourceManagementController::class, 'renderListPage'])
                ->name('resource-management.list-page');

            Route::get('resource-management/create-page', [ResourceManagementController::class, 'renderCreatePage'])
                ->name('resource-management.create-page');

            Route::post('resource-management/store', [ResourceManagementController::class, 'store'])
                ->name('resource-management.store');
        }
    );
