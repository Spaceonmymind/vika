<?php

namespace Modules\Chat\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Illuminate\Validation\Rule;
use Modules\Chat\Services\AdminIntentStatisticService;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController\ExportIntentsHistoryRecords;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController\ExportTopIntents;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController\GetIntentsHistoryRecords;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController\GetIntentStatisticByDays;
use Modules\Chat\Swagger\Docs\Attributes\AdminIntentStatisticController\GetTopIntents;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'AdminIntentStatisticController', description: 'Статистика определения интентов')]
class AdminIntentStatisticController extends Controller
{
    private AdminIntentStatisticService $adminIntentStatisticService;

    /**
     * @param AdminIntentStatisticService $adminIntentStatisticService
     */
    public function __construct(AdminIntentStatisticService $adminIntentStatisticService)
    {
        $this->adminIntentStatisticService = $adminIntentStatisticService;
        Context::add('module', 'Admin');

    }

    #[GetTopIntents]
    public function getTopIntents(Request $request)
    {
        $validated = $request->validate([
            'date_from' => 'sometimes|nullable|date',
            'date_to' => 'sometimes|nullable|date|after_or_equal:from',
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'chat_id' => 'sometimes|nullable',
            'from_tg' => 'sometimes|boolean|nullable',
            'from_max' => 'sometimes|boolean|nullable',
            'limit' => 'sometimes|integer|nullable|min:1',
        ]);
        return $this->adminIntentStatisticService->getTopIntents($validated);
    }

    #[GetIntentsHistoryRecords]
    public function getIntentsHistoryRecords(Request $request)
    {
        $validated = $request->validate([
            'date_from' => 'sometimes|nullable|date',
            'date_to' => 'sometimes|nullable|date|after_or_equal:from',
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'chat_id' => 'sometimes|nullable',
            'from_tg' => 'sometimes|boolean|nullable',
            'from_max' => 'sometimes|boolean|nullable',
            'per_page' => 'sometimes|integer|nullable|min:1',
            'intent_id' => 'sometimes|integer|nullable|exists:chat_intents,id',
        ]);
        return $this->adminIntentStatisticService->getIntentsHistoryRecords($validated);
    }

    #[GetIntentStatisticByDays]
    public function getIntentStatisticByDays(Request $request)
    {
        $validated = $request->validate([
            'intent_id' => 'required|integer|exists:chat_intents,id',
            'date_from' => 'required|nullable|date',
            'date_to' => 'required|nullable|date|after_or_equal:from',
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'from_tg' => 'sometimes|boolean|nullable',
            'from_max' => 'sometimes|boolean|nullable',
            'chat_id' => 'sometimes|nullable',
        ]);
        return $this->adminIntentStatisticService->getIntentStatisticByDays($validated);
    }

    #[ExportTopIntents]
    public function exportTopIntents(Request $request)
    {
        $validated = $request->validate([
            'date_from' => 'sometimes|nullable|date',
            'date_to' => 'sometimes|nullable|date|after_or_equal:from',
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'chat_id' => 'sometimes|nullable',
            'from_tg' => 'sometimes|boolean|nullable',
            'from_max' => 'sometimes|boolean|nullable',
            //'limit' => 'sometimes|integer|nullable|min:1',
        ]);
        return $this->adminIntentStatisticService->exportTopIntents($validated);
    }

    #[ExportIntentsHistoryRecords]
    public function exportIntentsHistoryRecords(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['required', Rule::date()->after(Carbon::parse($request->get('date_to', Carbon::now()))->subDays(180))],
            'date_to' => ['required', 'date', 'after_or_equal:from'],
            'vika_type_id' => 'sometimes|integer|nullable|exists:chat_vika_types,id',
            'chat_id' => 'sometimes|nullable',
            'from_tg' => 'sometimes|boolean|nullable',
            'from_max' => 'sometimes|boolean|nullable',
            'intent_id' => 'sometimes|integer|nullable|exists:chat_intents,id',
        ]);
        return $this->adminIntentStatisticService->exportIntentsHistoryRecords($validated);
    }
}
