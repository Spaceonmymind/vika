<?php

use Illuminate\Support\Facades\Route;
use Modules\Esia\Http\Controllers\EsiaController;

/*
 * Роуты аутентификации
 */
Route::prefix('esia')->group(function () {
    Route::get('login', [EsiaController::class, 'redirect'])
        ->middleware(['throttle:esia'])
        ->name('esia.login');
    Route::get('callback', [EsiaController::class, 'callback'])
        ->middleware(['throttle:esia'])
        ->name('esia.callback');

    Route::get('error', static function () {
        return 'Ошибка авторизации через ЕСИА.';
    })->name('esia.error');
});
