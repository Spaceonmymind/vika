<?php

use Illuminate\Support\Facades\Route;
use Modules\HumanitarianPointsWidget\Http\Controllers\HumanitarianPointsWidgetController;

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

Route::prefix('widget/humanitarian_points')
    ->group(function () {
        Route::any('get_municipalities', [HumanitarianPointsWidgetController::class, 'getMunicipalities']);
        Route::any('get_humanitarian_points', [HumanitarianPointsWidgetController::class, 'getHumanitarianPoints']);
});
