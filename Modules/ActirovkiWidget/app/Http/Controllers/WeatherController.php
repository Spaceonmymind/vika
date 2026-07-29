<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\ActirovkiWidget\Http\Requests\StoreWeatherRequest;
use Modules\ActirovkiWidget\Http\Resources\WeatherResource;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Services\ActirovkiService;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherController\Destroy;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherController\ExportCsv;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherController\Index;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherController\Store;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WeatherController extends Controller
{
    #[Index]
    public function index(Request $request): Responsable
    {
        $weathers = QueryBuilder::for(Weather::class)
            ->allowedFilters([
                AllowedFilter::exact('city_id'),
                AllowedFilter::callback('date_from', static function ($query, $value) {
                    $query->where('created_at', '>=', CarbonImmutable::parse($value)->startOfDay());
                }),
                AllowedFilter::callback('date_to', static function ($query, $value) {
                    $query->where('created_at', '<=', CarbonImmutable::parse($value)->endOfDay());
                }),
            ])
            ->defaultSort('-created_at')
            ->paginate((int)$request->query('per_page', 50))
            ->appends($request->query());

        return WeatherResource::collection($weathers);
    }

    #[Store]
    public function store(StoreWeatherRequest $request, ActirovkiService $service): Responsable
    {
        $weather = Weather::query()->create($request->validated());
        $service->processWeather($weather);

        return new WeatherResource($weather);
    }

    #[Destroy]
    public function destroy(Weather $weather): Response
    {
        $weather->delete();
        return response()->noContent();
    }

    #[ExportCsv]
    public function exportCsv(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="actirovki-weather.csv"',
        ];

        $callback = static function () {
            $handle = fopen('php://output', 'wb');
            // BOM для Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Город',
                'Температура',
                'Ветер',
                'Дата и время получения данных от Юграметео',
            ], ';');

            QueryBuilder::for(Weather::class)
                ->allowedFilters([
                    AllowedFilter::exact('city_id'),
                    AllowedFilter::callback('date_from', static function ($query, $value) {
                        $query->where('created_at', '>=', CarbonImmutable::parse($value)->startOfDay());
                    }),
                    AllowedFilter::callback('date_to', static function ($query, $value) {
                        $query->where('created_at', '<=', CarbonImmutable::parse($value)->endOfDay());
                    }),
                ])
                ->with(['city'])
                ->chunkByIdDesc(1000, function ($weathers) use ($handle) {
                    foreach ($weathers as $weather) {
                        /** @var Weather $weather */
                        fputcsv($handle, [
                            $weather->id,
                            $weather->city->name,
                            "{$weather->temperature}°",
                            "$weather->wind м/с",
                            $weather->created_at->format('d.m.Y H:i'),
                        ], ';');
                    }
                });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
