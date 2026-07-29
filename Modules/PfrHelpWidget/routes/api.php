<?php

use Illuminate\Support\Facades\Route;
use Modules\PfrHelpWidget\Http\Controllers\PfrHelpWidgetController;

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

Route::prefix('widget/pfr_help')
    ->group(function () {
        Route::any('get_services',[PfrHelpWidgetController::class,'getServices']);
        Route::any('get_categories',[PfrHelpWidgetController::class,'getCategories']);
        Route::any('get_questions',[PfrHelpWidgetController::class,'getQuestions']);
    });

