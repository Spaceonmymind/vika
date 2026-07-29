<?php

use Illuminate\Support\Facades\Route;
use Modules\FuelPriceWidget\Http\Controllers\FuelPriceWidgetController;

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

Route::prefix('widget/fuel_price')
    ->group(function () {
        Route::controller(FuelPriceWidgetController::class)->group(function () {
            Route::get('get_fuel_types', 'getFuelTypes');
            Route::get('get_cities', 'getCities');
            Route::any('get_fuel_in_city', 'getFuelPricesInCity');
        });
    });
