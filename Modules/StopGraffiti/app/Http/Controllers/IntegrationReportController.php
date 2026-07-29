<?php

namespace Modules\StopGraffiti\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\StopGraffiti\Http\Requests\StoreReportRequest;
use Modules\StopGraffiti\Services\ReportService;
use Symfony\Component\HttpFoundation\Response;

class IntegrationReportController
{
    public function __construct(private readonly ReportService $reports) {}

    public function store(StoreReportRequest $request): JsonResponse
    {
        $report = $this->reports->receive($request->validated());

        return response()->json([
            'id' => $report->id,
            'external_id' => $report->external_id,
            'status' => $report->status,
        ], $report->wasRecentlyCreated ? Response::HTTP_CREATED : Response::HTTP_OK);
    }
}
