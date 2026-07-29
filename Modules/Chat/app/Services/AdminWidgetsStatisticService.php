<?php

namespace Modules\Chat\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Chat\Models\ChatWidget;
use Modules\Chat\Models\ChatWidgetUsageHistoryRecord;

class AdminWidgetsStatisticService
{

    public function getWidgetsStatisticByPeriod(
        Carbon $from,
        Carbon $to,
        ?bool  $fromTelegram,
        ?bool  $fromMax,
        ?bool  $isActiveWidget,
    ): Collection
    {
        return ChatWidgetUsageHistoryRecord::query()
            ->with([
                'widget' => function ($query) {
                    $query->select('id', 'code_name', 'name', 'description', 'is_active');
                }])
            ->selectRaw('widget_id, COUNT(*) as call_count')
            ->whereBetween('called_at', [$from, $to])
            ->when(isset($fromTelegram), function ($query) use ($fromTelegram) {
                return $query->where('from_tg', $fromTelegram);
            })
            ->when(isset($fromMax), function ($query) use ($fromMax) {
                return $query->where('from_max', $fromMax);
            })
            ->when(isset($isActiveWidget), function ($query) use ($isActiveWidget) {
                $query->whereHas('widget', function ($query) use ($isActiveWidget) {
                    $query->where('is_active', $isActiveWidget);
                });
            })
            ->orderBy('call_count', 'desc')
            ->groupBy('widget_id')
            ->get();
    }

    public function getWidgetStatisticByPeriodAndId(
        ChatWidget $widget,
        Carbon     $from,
        Carbon     $to,
                   $fromTelegram,
                   $fromMax
    ): array
    {
        $statistics = ChatWidgetUsageHistoryRecord::query()
            ->selectRaw('DATE(called_at) as date, COUNT(*) as call_count')
            ->where('widget_id', $widget->id)
            ->when(isset($fromTelegram), function ($query) use ($fromTelegram) {
                return $query->where('from_tg', $fromTelegram);
            })
            ->when(isset($fromMax), function ($query) use ($fromMax) {
                return $query->where('from_max', $fromMax);
            })
            ->whereBetween('called_at', [$from, $to])
            ->groupBy('date')
            ->orderBy('date')
            ->get()->keyBy('date');

        $result = [];
        for ($date = $from->copy(); $date->lte($to); $date->addDay()) {
            $formattedDate = $date->toDateString();
            $result[] = [
                'date' => $formattedDate,
                'call_count' => $statistics->get($formattedDate)->call_count ?? 0,
            ];
        }
        return $result;

//        $statistics = ChatWidgetUsageHistoryRecord::query()
//            ->selectRaw('YEARWEEK(called_at, 1) as week, MIN(DATE(called_at)) as start_date, MAX(DATE(called_at)) as end_date, COUNT(*) as call_count')
//            ->where('widget_id', $widget->id)
//            ->whereBetween('called_at', [$from, $to])
//            ->groupBy('week')
//            ->orderBy('week')
//            ->get();
    }
}
