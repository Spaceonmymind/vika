<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Modules\DoctorTmkWidget\Http\Controllers\DoctorTmkWidgetController;

Route::prefix('widget/doctor-tmk')->group(function () {
    //Route::any('consultations', [DoctorTmkWidgetController::class, 'telemedicineConsultations'])->middleware(EnsureFrontendRequestsAreStateful::class);
});
