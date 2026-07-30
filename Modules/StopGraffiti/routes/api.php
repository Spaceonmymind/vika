<?php

use Illuminate\Support\Facades\Route;
use Modules\StopGraffiti\Http\Controllers\AdminReportController;
use Modules\StopGraffiti\Http\Controllers\IntegrationReportController;
use Modules\StopGraffiti\Http\Middleware\AuthenticateIntegration;

Route::prefix('integrations/stop-graffiti')
    ->middleware(AuthenticateIntegration::class)
    ->group(function (): void {
        Route::post('reports', [IntegrationReportController::class, 'store']);
    });

Route::get('admin/stop-graffiti/media/{media}', [AdminReportController::class, 'downloadMedia'])
    ->middleware('signed')
    ->name('stop-graffiti.media');

Route::prefix('admin/stop-graffiti')
    ->middleware(['auth:sanctum', 'permission:manage_stop_graffiti'])
    ->group(function (): void {
        Route::get('reports', [AdminReportController::class, 'index']);
        Route::get('metadata', [AdminReportController::class, 'metadata']);
        Route::get('reports/{report}', [AdminReportController::class, 'show']);
        Route::patch('reports/{report}', [AdminReportController::class, 'update']);
    });
