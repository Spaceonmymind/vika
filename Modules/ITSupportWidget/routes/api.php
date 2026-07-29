<?php

use Illuminate\Support\Facades\Route;
use Modules\ITSupportWidget\Http\Controllers\ITSupportWidgetController;

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


Route::prefix('widget/it_support')->group(function () {
    Route::any('get_measures', [ITSupportWidgetController::class, 'getMeasures']);
});
