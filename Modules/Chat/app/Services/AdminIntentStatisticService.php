<?php

namespace Modules\Chat\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Chat\Exports\IntentsHistoryByPeriod;
use Modules\Chat\Exports\IntentsStatisticByPeriod;
use Modules\Chat\Models\ChatIntentHistoryRecord;

class AdminIntentStatisticService
{

    /**
     * Возвращает топ интентов за определенный период
     * @param $filters
     * @return \Illuminate\Support\Collection
     */
    public function getTopIntents($filters = [])
    {
        return $this
            ->getBaseQuery($filters)
            ->select([
                DB::raw('COUNT(*) as count'),
                'intent_id',
            ])
            ->with([
                'chat_intent:id,code,name,active',
            ])
            ->groupBy('intent_id')
            ->orderByDesc('count')
            ->limit($filters['limit'] ?? 10)
            ->get();
    }

    /**
     * Возвращает базовый запрос фильтрации для истории интентов
     * @param $filters
     * @return Builder
     */
    private function getBaseQuery($filters = []): Builder
    {
        return ChatIntentHistoryRecord::query()
            ->when(isset($filters['date_from']), function (Builder $q) use ($filters) {
                $q->where('created_at_date', '>=', Carbon::parse($filters['date_from'])->format('Y-m-d'));
            })
            ->when(isset($filters['date_to']), function (Builder $q) use ($filters) {
                $q->where('created_at_date', '<=', Carbon::parse($filters['date_to'])->format('Y-m-d'));
            })
            ->when(isset($filters['vika_type_id']), function (Builder $q) use ($filters) {
                $q->where('vika_type_id', $filters['vika_type_id']);
            })
            ->when(isset($filters['intent_id']), function (Builder $q) use ($filters) {
                $q->where('intent_id', $filters['intent_id']);
            })
            ->when(isset($filters['chat_id']), function (Builder $q) use ($filters) {
                $q->where('chat_id', $filters['chat_id']);
            })
            ->when(isset($filters['from_tg']), function (Builder $q) use ($filters) {
                $q->where('from_tg', $filters['from_tg']);
            })
            ->when(isset($filters['from_max']), function (Builder $q) use ($filters) {
                $q->where('from_max', $filters['from_max']);
            });
    }

    /**
     * Возвращает записи истории интентов с учетом фильтров
     * @param $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getIntentsHistoryRecords($filters = [])
    {
        return $this
            ->getBaseQuery($filters)
            ->select([
                'id',
                'intent_id',
                'chat_id',
                'created_at',
                'from_tg',
                'from_max',
                'vika_type_id',
                'message',
                'entities',
            ])
            ->with([
                'chat_intent:id,code,name,active',
                'vika_type',
            ])
            ->orderByDesc('created_at')
            ->paginate($filters['per_page'] ?? 15);
    }

    /**
     * Возвращает статистику интента по дням
     * @param $filters
     * @return array
     */
    public function getIntentStatisticByDays($filters = [])
    {
        $statisticByDays = $this
            ->getBaseQuery($filters)
            ->select([
                'created_at_date',
                DB::raw('COUNT(*) as count'),
            ])
            ->groupBy('created_at_date')
            ->orderBy('created_at_date')
            ->get()
            ->keyBy(function ($item) {
                // @phpstan-ignore property.notFound
                return $item->created_at_date->format('d.m.Y');
            });

        $currentDate = Carbon::parse($filters['date_from']);
        $endDate = Carbon::parse($filters['date_to']);

        $result = [];
        while ($currentDate->lte($endDate)) {

            $result[] = [
                'date' => $currentDate->format('d.m.Y'),
                'count' => $statisticByDays[$currentDate->format('d.m.Y')]->count ?? 0,
            ];

            $currentDate->addDay();
        }

        return $result;
    }

    /**
     * Скачивает экспорт топа интентов за определенный период
     * @param $filters
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportTopIntents($filters = [])
    {
        $query = $this->getBaseQuery($filters);
        return Excel::download(new IntentsStatisticByPeriod($query),   'intents_statistic'.Carbon::now()->format('d_m_Y_H_i_s').'.xlsx');
    }

    /**
     * Скачивает экспорт истории интентов за определенный период
     * @param $filters
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function exportIntentsHistoryRecords($filters = [])
    {
        $query = $this->getBaseQuery($filters);
        return Excel::download(new IntentsHistoryByPeriod($query), 'intents_history_records'.Carbon::now()->format('d_m_Y_H_i_s').'.xlsx');
    }
}
