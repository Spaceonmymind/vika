<?php

namespace Modules\TimetableWidget\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\TimetableWidget\Models\Employee;
use Modules\TimetableWidget\Models\Timetable;

class TimetableWidgetService
{
    /**
     * Получает список сотрудников по ФИО и опционально по идентификатору организации.
     *
     * @param int|null $organizationId Идентификатор организации
     * @param string $fio ФИО для поиска
     *
     * @return Collection
     */
    public function getEmployees(?int $organizationId, string $fio)//: Collection
    {
        $query = Employee::whereFullText(
            ['name'],
            $fio,
            ['mode' => 'natural', 'expanded' => true] // Аналог fuzziness
        );

        if ($organizationId !== null) {
            $query->where('organization_id', $organizationId);
        }

        return $query
            ->limit(25) // Аналог size(25)
            ->get();
    }

    /**
     * Получает расписание для сотрудника по его глобальному идентификатору за заданный месяц и год.
     *
     * @param string $employeeUuid Глобальный идентификатор сотрудника
     * @param int $month Месяц
     * @param int $year Год
     *
     * @return Collection
     */
    public function getTimetable(string $employeeUuid, int $month, int $year): Collection
    {
        return Timetable::query()
            ->where('employee_global_id', $employeeUuid)
            ->where('month', $month)
            ->where('year', $year)
            ->get(['day', 'month', 'year', 'status'])
            ->append(['date']);
    }
}
