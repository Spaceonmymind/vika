<?php

namespace Modules\Chat\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Chat\Services\AdminWidgetsStatisticService;

class WidgetsStatisticByPeriod implements FromCollection, WithHeadings, WithColumnWidths, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    private AdminWidgetsStatisticService $service;
    private Carbon $from;
    private Carbon $to;
    private ?bool $fromTelegram;
    private ?bool $fromMax;
    private ?bool $isActiveWidget;

    public function __construct(
        AdminWidgetsStatisticService $service,
        Carbon                       $from,
        Carbon                       $to,
        ?bool                        $fromTelegram = null,
        ?bool                        $fromMax = null,
        ?bool                        $isActiveWidget = null
    )
    {
        $this->service = $service;
        $this->from = $from;
        $this->to = $to;
        $this->fromTelegram = $fromTelegram;
        $this->fromMax = $fromMax;
        $this->isActiveWidget = $isActiveWidget;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        $statistics = $this->service->getWidgetsStatisticByPeriod(
            $this->from,
            $this->to,
            $this->fromTelegram,
            $this->fromMax,
            $this->isActiveWidget,
        );

        return $statistics->map(function ($item, $index) {
            return [
                'number' => ++$index,
                'name' => $item->widget->name,
                'call_count' => $item->call_count,
            ];
        });
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        return ['№', 'Название виджета', 'Количество посещений'];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->mergeCells('A1:C1'); // Объединяем ячейки для заголовка
                $sheet->setCellValue('A1', sprintf(
                    'Статистика по виджетам за период с %s по %s',
                    $this->from->isoFormat('DD.MM.YYYY'),
                    $this->to->isoFormat('DD.MM.YYYY')
                ));
                $sheet->getStyle('A1:C2')->getFont()->setBold(true);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center'); // Выравниваем по центру заголовок
                $sheet->getStyle('A2')->getAlignment()->setHorizontal('center'); // Выравниваем по центру №
            },
        ];
    }
}
