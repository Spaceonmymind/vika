<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\ActirovkiWidget\Helpers\ModuleLog;
use Modules\ActirovkiWidget\Http\Requests\FetchActirovkiByCityRequest;
use Modules\ActirovkiWidget\Http\Requests\StoreCityRequest;
use Modules\ActirovkiWidget\Http\Resources\ActirovkaResource;
use Modules\ActirovkiWidget\Http\Resources\CityResource;
use Modules\ActirovkiWidget\Http\Resources\WeatherRangeResource;
use Modules\ActirovkiWidget\Http\Resources\WeatherResource;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Models\WeatherRange;
use Modules\ActirovkiWidget\Services\ActirovkiService;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\Destroy;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\FetchActirovkiForSpecificDay;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\FetchActirovkiToday;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\Index;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\LatestWeatherByCity;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\Show;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\Store;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\Update;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\WeatherByCity;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\CityController\WeatherRangeByCity;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    public function __construct(private ActirovkiService $actirovkiService)
    {
        parent::__construct();
    }

    #[Index]
    public function index(Request $request): Responsable
    {
        $builder = QueryBuilder::for(City::class)
            ->allowedFilters(['name'])
            ->defaultSort('name')
            ->allowedSorts('name');

        if ($request->has('page')) {
            $cities = $builder
                ->paginate((int)$request->query('per_page', 15))
                ->appends($request->query());
        } else {
            $cities = $builder->get();
        }

        return CityResource::collection($cities);
    }

    #[Show]
    public function show(City $city): Responsable
    {
        return new CityResource($city);
    }

    #[WeatherByCity]
    public function weatherByCity(City $city, Request $request): Responsable
    {
        return WeatherResource::collection(
            Weather::query()
                ->where('city_id', $city->id)
                ->paginate((int)$request->query('per_page', 15)),
        );
    }

    #[LatestWeatherByCity]
    public function latestWeatherByCity(City $city): Responsable
    {
        $today = CarbonImmutable::today();

        return WeatherResource::make(
            Weather::query()
                ->where('city_id', $city->id)
                ->whereBetween('created_at', [$today->startOfDay(), $today->endOfDay()])
                ->orderByDesc('id')
                ->firstOrFail(),
        );
    }

    #[WeatherRangeByCity]
    public function weatherRangesByCity(City $city, Request $request): Responsable
    {
        return WeatherRangeResource::collection(
            WeatherRange::query()
                ->where('city_id', $city->id)
                ->orderBy('school_class')
                ->orderBy('temperature', 'desc')
                ->paginate((int)$request->query('per_page', 15)),
        );
    }

    #[Store]
    public function store(StoreCityRequest $request)
    {
        try {
            $city = DB::transaction(static function () use ($request) {
                $city = City::query()->create($request->validated());

                if ($referenceId = $request->input('reference_city_id')) {
                    $referenceWeatherRanges = WeatherRange::query()
                        ->where('city_id', $referenceId)
                        ->get()
                        ->map(fn(WeatherRange $range) => $range->replicate());

                    $city->actirovki_widget_weather_ranges()->saveMany($referenceWeatherRanges);
                }

                return $city;
            });
        } catch (\Throwable $e) {
            ModuleLog::module()->error('CityController@store failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Не удалось создать город. Попробуйте ещё раз.' . $e->getMessage()
            ], 500);
        }

        return new CityResource($city);
    }

    #[Update]
    public function update(StoreCityRequest $request, City $city): Responsable
    {
        $city->update($request->validated());

        return new CityResource($city);
    }

    #[Destroy]
    public function destroy(City $city): Response
    {
        $city->delete();

        return response()->noContent();
    }

    #[FetchActirovkiForSpecificDay]
    public function fetchActirovkiForSpecificDay(City $city, FetchActirovkiByCityRequest $request): Responsable
    {
        $date = CarbonImmutable::parse($request->query('date'));
        $data = $this->actirovkiService->fetchActirovkiByDate($city->id, $date);

        return ActirovkaResource::collection($data);
    }

    #[FetchActirovkiToday]
    public function fetchActirovkiToday(City $city): Responsable
    {
        $data = $this->actirovkiService->fetchActirovkiToday($city->id);

        return ActirovkaResource::collection($data);
    }


}
