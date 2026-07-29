<?php

use Illuminate\Support\Facades\Route;
use Modules\MFCApplicationStatusCheckWidget\Http\Controllers\MFCApplicationStatusCheckWidgetController;

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

Route::prefix('widget/mfc_application_status')->group(function (){
   Route::any('get_application_status',[MFCApplicationStatusCheckWidgetController::class,'getApplicationStatusByNumberOrSnils']);
});
