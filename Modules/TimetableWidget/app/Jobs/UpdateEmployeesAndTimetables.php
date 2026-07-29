<?php

namespace Modules\TimetableWidget\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\TimetableWidget\Models\Employee;
use Modules\TimetableWidget\Models\Timetable;

class UpdateEmployeesAndTimetables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private const int COUNT_OF_MONTHS = 2;
    private int $organizationId;
    //private const string TIMESHEET_URL = 'http://5.141.28.74:5509/api/timesheet/GetOrganizationsTables?';
    private string $organizationGlobalId;
    private string $organizationName;
    private readonly string $timesheetUrl; // Количество попыток выполнения задачи

    /**
     * Create a new job instance.
     */
    public function __construct(int $organizationId, string $organizationGlobalId, string $organizationName)
    {
        $this->organizationId = $organizationId;
        $this->organizationGlobalId = $organizationGlobalId;
        $this->organizationName = $organizationName;
        $this->timesheetUrl = config('services.timetable.timesheet_url');
    }

    /**
     * Execute the job.
     * @throws \Throwable
     */
    public function handle(): void
    {
        $organizationId = $this->organizationId;
        $organizationGlobalId = $this->organizationGlobalId;

        $currentDate = Carbon::now();
        // Берем диапазон информации за N будущих месяца
        for ($i = 0; $i < self::COUNT_OF_MONTHS; $i++) {
            $attempts = 0;
            $maxAttempts = 5;
            while (true) {
                try {
                    DB::transaction(function () use ($i, $currentDate, $organizationId, $organizationGlobalId) {
                        // Получаем дату с добавлением $i месяцев
                        $newDate = $currentDate->copy()->addMonths($i);

                        $params = [
                            'Year' => $newDate->year,
                            'Month' => $newDate->month,
                            'global_id' => $organizationGlobalId,
                        ];

                        $data = Http::acceptJson()->timeout(90)->post($this->timesheetUrl, $params);

                        if (!$data->ok() || empty($data->body())) {
                            Log::channel('telegram_timetable')->error(
                                'Ошибка получения графика работ организации ' . $organizationId,
                                [
                                    'status_code' => $data->status(),
                                    'organization_global_id' => $organizationGlobalId,
                                    'organization_name' => $this->organizationName,
                                ],
                            );

                            return;
                        }

                        $data = $data->json();

                        if (empty($data['Execposts'])) {
                            return;
                        }

                        if ($i === 0) {
                            //Удаляем старые записи только при обработке первого месяца
                            //В последующих месяцах удаление не нужно, чтобы не удалить только что добавленные записи предыдущего месяца
                            $this->deleteOldRecords($organizationId, $newDate, self::COUNT_OF_MONTHS);
                        }
                        $this->deleteOrganizationTimetablesForSpecificDate($organizationId, $newDate);

                        $employeesToCreate = [];
                        $timetablesToCreate = [];

                        foreach ($data['Execposts'] as $employee) {
                            $empObject = [
                                'organization_id' => $organizationId,
                                'global_id' => $employee['Execpostid'],
                                'post' => $employee['ExecpostName'],
                                'name' => $employee['EmployeeName'],
                            ];
                            //Тут ключ добавляется наверно, чтобы избежать дублирование записей с одинаковым ключом
                            $employeesToCreate[$empObject['global_id']] = $empObject;

                            foreach ($employee['ExecpostDayInfos'] as $day) {
                                if (!empty($day)) {
                                    $timetablesToCreate[] = [
                                        'month' => $newDate->month,
                                        'year' => $newDate->year,
                                        'day' => $day['DayNumber'],
                                        'status' => $day['DayInfos'][0]['StateId'],
                                        'employee_global_id' => $employee['Execpostid'],
                                    ];
                                }
                            }
                        }

                        foreach (array_chunk($employeesToCreate, 500) as $employees) {
                            Employee::query()->upsert(
                                $employees,
                                ['global_id'],
                                ['organization_id', 'post', 'name']
                            );
                        }

                        foreach (array_chunk($timetablesToCreate, 500) as $timetables) {
                            Timetable::query()->insert($timetables);
                        }
                    }, $maxAttempts); // 5 попыток транзакции
                    break; // если транзакция успешна, выходим из while
                } catch (\Throwable $e) {
                    $attempts++;
                    if ($attempts >= $maxAttempts || !str_contains($e->getMessage(), 'Deadlock')) {
                        Log::channel('timetable_good_people')->error('Ошибка при запросе расписания',
                            [
                                'class' => __CLASS__,
                                'error' => $e->getMessage(),
                                'trace' => $e->getTraceAsString(),
                            ]);
                        throw $e;
                    }
                    // Ждем немного перед повтором
                    usleep(500_000); // 0.5 секунды
                }
            }
        }
    }

    /**
     * Удалить все записи табеля за указанный месяц и год в организации
     * @param $organizationId
     * @param Carbon $date
     * @return void
     */
    private function deleteOrganizationTimetablesForSpecificDate($organizationId, Carbon $date): void
    {
        $month = $date->month;
        $year = $date->year;

        Timetable::query()
            ->whereHas('employee', function ($q) use ($organizationId) {
                $q->where('organization_id', '=', $organizationId);
            })
            ->where(function ($q) use ($month, $year) {
                $q->where('month', $month)
                    ->where('year', $year);
            })
            ->delete();
    }

    /**
     * Удалить старые записи табелей и сотрудников организации за пределами указанного количества месяцев
     * @param $organizationId
     * @param Carbon $date
     * @param $countOfMonths
     * @return void
     */
    private function deleteOldRecords($organizationId, Carbon $date, $countOfMonths): void
    {
        $months = [];
        $years = [];

        for ($i = 0; $i < $countOfMonths; $i++) {
            $months[] = $date->copy()->addMonths($i)->month;
            $years[] = $date->copy()->addMonths($i)->year;
        }

        //Сотрудники организации $organizationId, у которых есть табель в текущем месяце
        $activeEmployeeIds = Timetable::query()
            ->whereHas('employee', function ($q) use ($organizationId) {
                $q->where('organization_id', '=', $organizationId);
            })
            ->whereIn('month', $months)
            ->whereIn('year', $years)
            ->pluck('employee_global_id')
            ->unique();

        //Удаляем все табели, кроме текущего месяца, где есть сотрудники организации $organizationId
        Timetable::query()
            ->whereHas('employee', function ($q) use ($organizationId) {
                $q->where('organization_id', '=', $organizationId);
            })
            ->where(function ($q) use ($months, $years) {
                $q->whereNotIn('month', $months)
                    ->orWhereNotIn('year', $years);
            })
            ->delete();

        //Удаляем сотрудников организации $organizationId, у которых нет табеля в текущем месяце
        Employee::query()
            ->where('organization_id', '=', $organizationId)
            ->whereNotIn('global_id', $activeEmployeeIds)
            ->delete();
    }
}
