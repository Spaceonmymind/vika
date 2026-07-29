<?php

namespace Modules\Chat\Exports;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Chat\Models\ChatIntentHistoryRecord;
use PhpOffice\PhpSpreadsheet\Style\Style;

/**
 * Class IntentsStatisticByPeriod
 * @package Modules\Chat\Exports
 *
 * @property \Illuminate\Database\Eloquent\Builder<ChatIntentHistoryRecord> $baseQuery
 */
class IntentsHistoryByPeriod implements FromCollection, WithHeadings, WithColumnWidths, ShouldAutoSize, WithDefaultStyles
{
    private Builder|ChatIntentHistoryRecord $baseQuery;

    public function __construct(
        Builder|ChatIntentHistoryRecord $baseQuery,
    ) {
        $this->baseQuery = $baseQuery;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->baseQuery
            ->select([
                'id',
                'intent_id',
                'chat_id',
                'created_at',
                'from_tg',
                'vika_type_id',
                'message',
                'entities',
            ])
            ->with([
                'chat_intent',
                'vika_type',
            ])
            ->orderByDesc('created_at')
            ->get()
            // @phpstan-ignore argument.unresolvableType
            ->map(function ($item): array {
                return [
                    // @phpstan-ignore  property.notFound
                    $item->message,
                    // @phpstan-ignore  property.notFound
                    $item->chat_intent->name,
                    // @phpstan-ignore  property.notFound
                    $item->chat_id,
                    // @phpstan-ignore  property.notFound
                    $item->created_at->format('d.m.Y H:i:s'),
                    // @phpstan-ignore  property.notFound
                    $item->from_tg ? 'Да' : 'Нет',
                    // @phpstan-ignore  property.notFound
                    $item->vika_type->description,
                    implode(";\n", array_map(function ($entity) {
                        if( !isset($entity['value']) || !isset($entity['type'])) {
                            return '';
                        }
                        return $entity['value'] . ' (' . $entity['type'] . ')';
                            // @phpstan-ignore  property.notFound
                    }, $item->entities
                        )
                    ),
                ];
            });
    }


    public function headings(): array
    {
        return ['Сообщение', 'Название интента', 'Идентификатор чата', 'Дата отправки', 'Отправлено из Telegram', 'Тип Вики', 'Найденные сущности'];
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
}
