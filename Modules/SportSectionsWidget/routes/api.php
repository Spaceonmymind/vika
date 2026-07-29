<?php

use Illuminate\Support\Facades\Route;
use Modules\SportSectionsWidget\Http\Controllers\SportSectionsWidgetController;

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

Route::prefix('widget/sport_sections')
    ->group(function () {
        Route::controller(SportSectionsWidgetController::class)->group(function () {
            Route::get('get_cities', 'getCities');
            Route::get('get_sport_types', 'getSportTypes');
            Route::get('get_sections', 'getSections');
        });
    });
