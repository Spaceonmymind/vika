<?php

use Illuminate\Support\Facades\Route;
use Modules\Esia\Http\Controllers\EsiaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('esias', EsiaController::class)->names('esia');
});
