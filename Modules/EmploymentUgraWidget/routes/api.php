<?php

use Illuminate\Support\Facades\Route;
use Modules\EmploymentUgraWidget\Http\Controllers\EmploymentUgraWidgetController;

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

Route::prefix('widget/employment_ugra')
    ->group(function () {
        Route::any('get_categories',[EmploymentUgraWidgetController::class,'getCategories']);
        Route::any('get_questions',[EmploymentUgraWidgetController::class,'getQuestions']);
    });
