<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Modules\DoctorTmkWidget\Http\Controllers\DoctorTmkWidgetController;
use Modules\RegionHeadHotlineWidget\Http\Middleware\CheckVilarAccess;

Route::prefix('widget/doctor-tmk')->group(function () {
    Route::post('telemost/meeting', [DoctorTmkWidgetController::class, 'createTelemostMeeting']);
    Route::any('consultations', [DoctorTmkWidgetController::class, 'telemedicineConsultations']);
    Route::any('send_notification', [DoctorTmkWidgetController::class, 'sendTmkNotification'])->middleware([CheckVilarAccess::class]);

});
