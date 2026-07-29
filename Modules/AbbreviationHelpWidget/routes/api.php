<?php

use Illuminate\Support\Facades\Route;
use Modules\AbbreviationHelpWidget\Http\Controllers\AbbreviationHelpWidgetController;

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

Route::prefix('widget/abbreviation_help')
    ->group(function () {
        Route::any('get_abbreviations', [AbbreviationHelpWidgetController::class, 'getAbbreviations']);
});
