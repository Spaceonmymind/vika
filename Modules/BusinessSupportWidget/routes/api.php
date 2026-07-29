<?php

use Illuminate\Support\Facades\Route;
use Modules\BusinessSupportWidget\Http\Controllers\BusinessSupportWidgetController;

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

Route::prefix('widget/business_support')
    ->group(function () {
        Route::any('get_registration_places',[BusinessSupportWidgetController::class,'getRegistrationPlaces']);
        Route::any('get_situations',[BusinessSupportWidgetController::class,'getSituations']);
        Route::any('get_subjects',[BusinessSupportWidgetController::class,'getSubjects']);
        Route::any('get_support_organisations',[BusinessSupportWidgetController::class,'getSupportOrganisations']);
        Route::any('get_support_types',[BusinessSupportWidgetController::class,'getSupportTypes']);
        Route::any('get_measures',[BusinessSupportWidgetController::class,'getMeasures']);
    });
