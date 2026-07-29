<?php

namespace Modules\TimetableWidget\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Context;
use Modules\TimetableWidget\Models\Organization;
use Modules\TimetableWidget\Services\TimetableWidgetService;
use Modules\TimetableWidget\Swagger\Docs\Attributes\GetEmployees;
use Modules\TimetableWidget\Swagger\Docs\Attributes\GetOrganizations;
use Modules\TimetableWidget\Swagger\Docs\Attributes\GetTimetable;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'TimetableWidget', description: 'Виджет "График работы сотрудников (Табель)"')]
class TimetableWidgetController extends Controller
{

    private TimetableWidgetService $timetableService;

    public function __construct(TimetableWidgetService $service)
    {
        $this->timetableService = $service;
        Context::add('module', 'TimetableWidget');

    }

    #[GetOrganizations]
    public function getOrganizations(Request $request)
    {
        return Organization::query()
            ->whereHas('employees')
            ->get(['id', 'name', 'timesheet_name']);
    }

    #[GetEmployees]
    public function getEmployees(Request $request)
    {
        $validated = $request->validate([
            'organization_id' => 'sometimes|exists:timetable_widget_organizations,id',
            'fio' => 'required|min:2',
        ]);
        return $this->timetableService->getEmployees(
            $validated['organization_id'] ?? null,
            $validated['fio']
        );
    }

    #[GetTimetable]
    public function getTimetable(Request $request)
    {
        $validated = $request->validate([
            'employee_uuid' => 'required|exists:timetable_widget_employees,global_id',
            'month' => 'required|numeric|min:1|max:12',
            'year' => 'required|numeric|digits:4',
        ]);
        return $this->timetableService->getTimetable(
            $validated['employee_uuid'],
            $validated['month'],
            $validated['year']);
    }
}
