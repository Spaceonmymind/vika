<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Modules\ActirovkiWidget\Http\Resources\RowResource;
use Modules\ActirovkiWidget\Models\Row;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\RowController\Cancel;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\RowController\ExportCsv;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\RowController\Index;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RowController extends Controller
{

    #[Index]
    public function index(Request $request): Responsable
    {
        $rows = QueryBuilder::for(Row::class)
            ->allowedFilters([
                AllowedFilter::exact('city_id'),
                AllowedFilter::exact('school_shift'),
                AllowedFilter::exact('school_class', 'weather_range.school_class'),
                AllowedFilter::callback('date_from', static function ($query, $value) {
                    $query->where('created_at', '>=', CarbonImmutable::parse($value)->startOfDay());
                }),
                AllowedFilter::callback('date_to', static function ($query, $value) {
                    $query->where('created_at', '<=', CarbonImmutable::parse($value)->endOfDay());
                }),
            ])
            ->defaultSort('-created_at')
            ->with(['weather', 'weather_range', 'cancel_user'])
            ->paginate((int)$request->query('per_page', 50))
            ->appends($request->query());

        return RowResource::collection($rows);
    }

    #[Cancel]
    public function cancel(Row $row): Responsable
    {
        $row
            ->cancelBy(auth()->id())
            ->save();

        return new RowResource($row);
    }

    #[ExportCsv]
    public function exportCsv(): StreamedResponse
    {
        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="actirovki.csv"',
        ];

        $callback = static function () {
            $handle = fopen('php://output', 'wb');
            // BOM для Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'Город',
                'Смена',
                'Классы',
                'Температура',
                'Ветер',
                'Правило',
                'Дата и время создания',
                'Активность',
            ], ';');

            QueryBuilder::for(Row::class)
                ->allowedFilters([
                    AllowedFilter::exact('city_id'),
                    AllowedFilter::exact('school_shift'),
                    AllowedFilter::exact('school_class', 'weather_range.school_class'),
                    AllowedFilter::callback('date_from', static function ($query, $value) {
                        $query->where('created_at', '>=', CarbonImmutable::parse($value)->startOfDay());
                    }),
                    AllowedFilter::callback('date_to', static function ($query, $value) {
                        $query->where('created_at', '<=', CarbonImmutable::parse($value)->endOfDay());
                    }),
                ])
                ->with(['weather', 'weather_range', 'cancel_user', 'city', 'cancel_user'])
                ->orderBy('id')
                ->chunkByIdDesc(1000, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        /** @var Row $row */
                        fputcsv($handle, [
                            $row->city->name,
                            $row->school_shift,
                            "С 1 по {$row->weather_range->school_class}",
                            "{$row->weather->temperature}°",
                            "{$row->weather->wind} м/с",
                            sprintf(
                                'Температура %s°C, Ветер %s м/с',
                                $row->weather_range->temperature,
                                $row->weather_range->wind
                            ),
                            $row->created_at->format('d.m.Y H:i'),
                            ($row->cancel_at !== null)
                                ? "Отменена пользователем {$row->cancel_user?->name} ({$row->cancel_user?->email})"
                                : "Активна",
                        ], ';');
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
