<?php

use Illuminate\Support\Facades\Route;
use Modules\PetWidget\Http\Controllers\VetAreaController;
use Modules\PetWidget\Http\Controllers\VetClinicController;
use Modules\PetWidget\Http\Controllers\VetReferenceController;
use Modules\PetWidget\Http\Controllers\VetShelterController;

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

Route::prefix('widget/pet')->group(function (){
   Route::any('get_localities',[VetReferenceController::class,'getLocalities']);
   Route::any('shelters/list',[VetShelterController::class,'getShelters']);
   Route::any('clinics/list',[VetClinicController::class,'getClinics']);
   Route::any('areas/list',[VetAreaController::class,'getAreas']);
});
