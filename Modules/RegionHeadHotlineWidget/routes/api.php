<?php

use Illuminate\Support\Facades\Route;
use Infinitypaul\Idempotency\Middleware\EnsureIdempotency;
use Modules\AppointmentToDoctorWidget\Http\Middleware\CheckMaxDataValid;
use Modules\RegionHeadHotlineWidget\Http\Controllers\RegionHeadHotlineWidgetController;
use Modules\RegionHeadHotlineWidget\Http\Middleware\CheckVilarAccess;

Route::prefix('widget/region_head_hotline')->group(function () {
    Route::any('get_bad_words', [RegionHeadHotlineWidgetController::class, 'getAppealBadWords']);
    Route::middleware([CheckMaxDataValid::class])->group(function () {
        Route::post('is_user_saved_contact', [RegionHeadHotlineWidgetController::class, 'isUserSavedContact']);
        Route::post('save_max_contact', [RegionHeadHotlineWidgetController::class, 'saveMaxContact'])/*->middleware(EnsureIdempotency::class)*/;
        Route::post('find_people_by_max', [RegionHeadHotlineWidgetController::class, 'findPeopleByMax']);
        Route::post('create_appeal', [RegionHeadHotlineWidgetController::class, 'createAppeal'])->middleware(EnsureIdempotency::class);
    });

    Route::post('send_result', [RegionHeadHotlineWidgetController::class, 'sendAppealResult'])->middleware([CheckVilarAccess::class]);
});
