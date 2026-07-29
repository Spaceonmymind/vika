<?php

use Illuminate\Support\Facades\Route;
use Modules\DistrictSearchWidget\Http\Controllers\DistrictSearchWidgetController;

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

Route::prefix('widget/district_search')
    ->group(function () {
        Route::any('get_cities',[DistrictSearchWidgetController::class,'getCities']);
        Route::any('get_streets',[DistrictSearchWidgetController::class,'getStreets']);
        Route::any('get_districts',[DistrictSearchWidgetController::class,'getDistricts']);
    });
