<?php

namespace Modules\Chat\Exports;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCharts;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Chat\Models\ChatIntentHistoryRecord;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Style\Style;

/**
 * Class IntentsStatisticByPeriod
 * @package Modules\Chat\Exports
 *
 * @property \Illuminate\Database\Eloquent\Builder<ChatIntentHistoryRecord> $baseQuery
 */
class IntentsStatisticByPeriod implements FromCollection, WithHeadings, WithColumnWidths, ShouldAutoSize, WithCharts
{
    private Builder|ChatIntentHistoryRecord $baseQuery;
    private int $dataCount = 0;

    public function __construct(
        Builder|ChatIntentHistoryRecord $baseQuery,
    ) {
        $this->baseQuery = $baseQuery;
    }

    public function headings(): array
    {
        return ['Название интента', 'Количество вызовов'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        $defaultStyle->getAlignment()->setWrapText(true);
    }

    public function charts()
    {
        $dataCount = $this->dataCount;

        if ($dataCount === 0) {
            return [];
        }

        $startRow = 2;
        $endRow = $dataCount + 1;
        $labels = [];
        for ($i = $startRow; $i <= $endRow; $i++) {
            $labels[] = new DataSeriesValues(
                DataSeriesValues::DATASERIES_TYPE_STRING,
                'Worksheet!$A$' . $i . ':$A$' . $i,
                null,
                1,
            );
        }

        $categories = [];
        for ($i = $startRow; $i <= $endRow; $i++) {
            $categories[] = new DataSeriesValues(
                DataSeriesValues::DATASERIES_TYPE_STRING,
                "Worksheet!\$B\$1",
                null,
                1,
            );
        }

        $values = [];
        for ($i = $startRow; $i <= $endRow; $i++) {
            $values[] = new DataSeriesValues(
                DataSeriesValues::DATASERIES_TYPE_NUMBER,
                "Worksheet!\$B\${$i}:\$B\${$i}",
                null,
                1,
            );
        }

        $series = new DataSeries(
            DataSeries::TYPE_BARCHART,
            null,
            range(0, $dataCount - 1),
            $labels,
            $categories,
            $values,
            DataSeries::DIRECTION_BAR, // горизонтальное направление

        );
        $layout = new Layout(['showVal' => true, 'showDataLabels' => true, 'showLegendKey' => true, 'showSerName' => true]);


        $plot = new PlotArea($layout, [$series]);

        // Убрать легенду
        $legend = null;

        $chart = new Chart(
            'Статистика',
            new Title('Статистика по интентам'),
            $legend,
            $plot,
        );

        $chart->setTopLeftPosition('D2');
        $chart->setBottomRightPosition('AA54');

        return $chart;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        $data = $this->baseQuery
            ->select([
                DB::raw('COUNT(*) as count'),
                'intent_id',
            ])
            ->with([
                'chat_intent:id,code,name,active',
            ])
            ->groupBy('intent_id')
            ->orderByDesc('count')
            ->get()
            // @phpstan-ignore  argument.unresolvableType
            ->map(function ($item): array {
                return [
                    // @phpstan-ignore  property.notFound
                    $item->chat_intent->name,
                    // @phpstan-ignore  property.notFound
                    $item->count,
                ];
            });

        $this->dataCount = $data->count();

        return $data;
    }
}
