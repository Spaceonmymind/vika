<?php

use Illuminate\Support\Facades\Route;
use Modules\SocialSupportWidget\Http\Controllers\SocialSupportWidgetController;

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

Route::prefix('widget/social_support')->group(function (){
    Route::any('get_preferential_categories',[SocialSupportWidgetController::class,'getPreferentialCategories']);
    Route::any('get_situations',[SocialSupportWidgetController::class,'getSituations']);
    Route::any('get_measures',[SocialSupportWidgetController::class,'getMeasures']);
});
