<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Chat\Exports\WidgetsStatisticByPeriod;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Services\AdminWidgetsStatisticService;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatStatisticController\ExportWidgetsStatisticSummary;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatStatisticController\GetWidgetsStatisticSummary;
use Modules\Chat\Swagger\Docs\Attributes\AdminChatStatisticController\GetWidgetStatisticByPeriodAndId;
use OpenApi\Attributes as OA;
use PhpOffice\PhpSpreadsheet\Exception;

#[OA\Tag(name: 'AdminWidgetsStatistic', description: 'Администрирование статистики виджетов')]
class AdminWidgetsStatisticController extends Controller
{
    protected AdminWidgetsStatisticService $adminWidgetsStatisticService;

    public function __construct(AdminWidgetsStatisticService $adminWidgetsStatisticService)
    {
        $this->adminWidgetsStatisticService = $adminWidgetsStatisticService;
        Context::add('module', 'Admin');

    }

    #[GetWidgetsStatisticSummary]
    public function getWidgetsStatisticByPeriod(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'from_telegram' => 'sometimes|boolean',
            'from_max' => 'sometimes|boolean',
            'is_active_widget' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetsStatisticService->getWidgetsStatisticByPeriod(
            Carbon::parse($validated['from'])->startOfDay(),
            Carbon::parse($validated['to'])->endOfDay(),
            $validated['from_telegram'] ?? null,
            $validated['from_max'] ?? null,
            $validated['is_active_widget'] ?? null,
        );
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    #[ExportWidgetsStatisticSummary]
    public function exportWidgetsStatisticByPeriod(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'from_telegram' => 'sometimes|boolean',
            'from_max' => 'sometimes|boolean',
            'is_active_widget' => 'sometimes|boolean',
        ]);

        $from = Carbon::parse($validated['from'])->startOfDay();
        $to = Carbon::parse($validated['to'])->endOfDay();
        return Excel::download(
            new WidgetsStatisticByPeriod(
                $this->adminWidgetsStatisticService,
                $from,
                $to,
                $validated['from_telegram'] ?? null,
                $validated['from_max'] ?? null,
                $validated['is_active_widget'] ?? null
            ),
            'widgets_statistic_from_' . $from->isoFormat('DD.MM.YYYY') . '_to_' . $to->isoFormat('DD.MM.YYYY') . '.xlsx'
        );

    }

    #[GetWidgetStatisticByPeriodAndId]
    public function getWidgetStatisticByPeriodAndId(Request $request, ChatWidget $widget)
    {
        $validated = $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
            'from_telegram' => 'sometimes|boolean',
            'from_max' => 'sometimes|boolean',
        ]);

        return $this->adminWidgetsStatisticService->getWidgetStatisticByPeriodAndId(
            $widget,
            Carbon::parse($validated['from'])->startOfDay(),
            Carbon::parse($validated['to'])->endOfDay(),
            $validated['from_telegram'] ?? null,
            $validated['from_max'] ?? null,
        );
    }

}
