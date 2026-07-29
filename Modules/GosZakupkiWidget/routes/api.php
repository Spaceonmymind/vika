<?php

use Illuminate\Support\Facades\Route;
use Modules\GosZakupkiWidget\Http\Controllers\GosZakupkiWidgetController;

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

Route::prefix('widget/gos_zakupki')->group(function () {
    Route::any('get_categories', [GosZakupkiWidgetController::class, 'getQuestionCategories']);
    Route::any('get_questions', [GosZakupkiWidgetController::class, 'getQuestions']);
});
