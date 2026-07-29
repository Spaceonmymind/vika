<?php

use Illuminate\Support\Facades\Route;
use Modules\TimetableWidget\Http\Controllers\TimetableWidgetController;

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

Route::prefix('widget/timetable')
    ->group(function () {
        Route::controller(TimetableWidgetController::class)->group(function () {
            Route::get('get_organizations', 'getOrganizations');
            Route::get('get_employees', 'getEmployees');
            Route::get('get_timetable', 'getTimetable');
        });
    });
