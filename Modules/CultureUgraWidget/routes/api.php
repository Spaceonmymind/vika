<?php

use Illuminate\Support\Facades\Route;
use Modules\CultureUgraWidget\Http\Controllers\CultureUgraWidgetController;

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
Route::prefix('widget/culture_ugra')->group(function () {
    Route::any('get_localities',[CultureUgraWidgetController::class,'getLocalities']);
    Route::any('get_events',[CultureUgraWidgetController::class,'getCultureEvents']);
});
