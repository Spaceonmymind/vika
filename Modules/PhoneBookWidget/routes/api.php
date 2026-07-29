<?php

use Illuminate\Support\Facades\Route;
use Modules\PhoneBookWidget\Http\Controllers\PhoneBookWidgetController;

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

Route::prefix('widget/phonebook')
    ->group(function () {
        Route::controller(PhoneBookWidgetController::class)->group(function () {
            Route::get('get_peoples_contacts', 'getPeoplesContacts');
        });
    });
