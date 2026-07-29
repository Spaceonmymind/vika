<?php

use Illuminate\Support\Facades\Route;
use Modules\InformationSystemsWidget\Http\Controllers\InformationSystemsWidgetController;

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

Route::prefix('widget/information_systems')
    ->group(function () {
        Route::controller(InformationSystemsWidgetController::class)->group(function () {
            Route::get('get_systems_list', 'getListOfInformationSystems');
            Route::get('get_purposes', 'getListOfPurposes');
            Route::get('get_owners', 'getListOfOwners');
            Route::get('get_operators', 'getListOfOperators');
        });
    });
