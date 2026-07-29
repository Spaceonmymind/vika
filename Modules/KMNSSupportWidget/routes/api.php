<?php

use Illuminate\Support\Facades\Route;
use Modules\KMNSSupportWidget\Http\Controllers\KMNSSupportWidgetController;

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


Route::prefix('widget/kmns_support')->group(function () {
   Route::any('get_activity_types', [KMNSSupportWidgetController::class, 'getActivityTypes']);
   Route::any('get_measures', [KMNSSupportWidgetController::class, 'getMeasures']);
});
