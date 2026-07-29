<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminUserController;
use Modules\Admin\Http\Controllers\RoleController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Middleware\DontTouchAdmin;
use Modules\Admin\Http\Middleware\DontTouchSuperUserRole;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('admin')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('get_token', [
            UserController::class,
            'getToken',
        ]);//этот метод может быть использован для получения токена на мобильном устройстве или на постмане
        Route::post('login', [UserController::class, 'login']);//а этот используется для логина с браузера
        Route::any('logout', [UserController::class, 'logOut'])->middleware('auth:sanctum');
        Route::any('logout_from_another_user', [AdminUserController::class, 'logOutFromUser'])->middleware('auth:sanctum');
        Route::any('me', [UserController::class, 'me'])->middleware('auth:sanctum');

        Route::post('send_reset_password_link', [UserController::class, 'sendResetPasswordLink'])->middleware('guest');
        Route::post('reset_password', [UserController::class, 'resetPassword'])->middleware('guest');
    });

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::middleware(['permission:administrate_users|administrate_roles'])->group(function (){
            Route::prefix('users')->group(function () {

                Route::any('get_permissions', [AdminUserController::class, 'getPermissions']);

            });
        });

        Route::middleware(['permission:administrate_users'])->group(function (){

            Route::prefix('users')->group(function () {

                Route::any('get_roles', [AdminUserController::class, 'getRoles']);
                Route::any('list', [AdminUserController::class, 'getUsers']);
                Route::post('create', [AdminUserController::class, 'createUser']);

                Route::prefix('{user}')
                    ->whereNumber('user')
                    ->middleware(DontTouchAdmin::class)
                    ->group(function () {

                        Route::any('get', [AdminUserController::class, 'getDetailUserInformation']);
                        Route::post('update', [AdminUserController::class, 'updateUser']);
                        Route::post('delete', [AdminUserController::class, 'deleteUser']);
                        Route::post('login', [AdminUserController::class, 'loginByUser']);

                    });

            });
        });
        Route::middleware(['permission:administrate_roles'])->group(function (){

            Route::prefix('roles')->group(function () {

                Route::any('list', [RoleController::class, 'getRoles']);
                Route::post('create',[RoleController::class,'createRole']);

                Route::prefix('{role}')
                    ->whereNumber('role')
                    ->middleware(DontTouchSuperUserRole::class)
                    ->group(function () {

                        Route::any('get', [RoleController::class, 'getRole']);
                        Route::post('update', [RoleController::class, 'updateRole']);
                        Route::post('delete', [RoleController::class, 'deleteRole']);

                    });

            });
        });

    });
});

