<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Modules\ActirovkiWidget\Http\Requests\StoreWeatherRangeRequest;
use Modules\ActirovkiWidget\Http\Resources\WeatherRangeResource;
use Modules\ActirovkiWidget\Models\WeatherRange;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController\Destroy;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController\Index;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController\Store;
use Modules\ActirovkiWidget\Swagger\Docs\Attributes\WeatherRangeController\Update;

class WeatherRangeController extends Controller
{
    #[index]
    public function index(): Responsable
    {
        return WeatherRangeResource::collection(
            WeatherRange::query()
                ->orderBy('city_id')
                ->orderBy('school_class')
                ->orderBy('temperature', 'desc')
                ->paginate(30)
        );
    }

    #[store]
    public function store(StoreWeatherRangeRequest $request): Responsable
    {
        $weatherRange = WeatherRange::query()->create($request->validated());

        return new WeatherRangeResource($weatherRange);
    }

    #[update]
    public function update(StoreWeatherRangeRequest $request, WeatherRange $weatherRange): WeatherRangeResource
    {
        $weatherRange->update($request->validated());

        return new WeatherRangeResource($weatherRange);
    }

    #[destroy]
    public function destroy(WeatherRange $weatherRange): Response
    {
        $weatherRange->delete();

        return response()->noContent();
    }
}
