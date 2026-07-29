<?php /** @noinspection PhpArgumentWithoutNamedIdentifierInspection */

use Modules\ActirovkiWidget\Http\Controllers\CityController;
use Modules\ActirovkiWidget\Http\Controllers\RowController;
use Modules\ActirovkiWidget\Http\Controllers\StatisticController;
use Modules\ActirovkiWidget\Http\Controllers\WeatherController;
use Modules\ActirovkiWidget\Http\Controllers\WeatherRangeController;


Route::prefix('widget/actirovki')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | С авторизацией
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth:sanctum', 'permission:actirovki'])->group(function () {
        // Города
        Route::post('cities', [CityController::class, 'store']);
        Route::post('cities/{city}/update', [CityController::class, 'update']);
        Route::post('cities/{city}/delete', [CityController::class, 'destroy']);

        Route::get('statistic', [StatisticController::class, 'byCity']);
        Route::get('statistic/all-today', [StatisticController::class, 'allToday']);

        // Погода
        Route::post('weathers', [WeatherController::class, 'store']);
        Route::post('weathers/{weather}/delete', [WeatherController::class, 'destroy']);
        Route::get('weathers/export-csv', [WeatherController::class, 'exportCsv']);

        // Диапазоны погоды для актироовок
        Route::post('weather-ranges', [WeatherRangeController::class, 'store']);
        Route::post('weather-ranges/{weather_range}/update', [WeatherRangeController::class, 'update']);
        Route::post('weather-ranges/{weather_range}/delete', [WeatherRangeController::class, 'destroy']);

        // Актировки
        Route::post('rows/{row}/cancel', [RowController::class, 'cancel']);
        Route::get('rows/export-csv', [RowController::class, 'exportCsv']);
    });

    /*
    |--------------------------------------------------------------------------
    | Публичные
    |--------------------------------------------------------------------------
    */
    Route::prefix('cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
        Route::get('/{city}', [CityController::class, 'show']);

        Route::prefix('{city}')->group(function () {
            // Погода
            Route::get('weathers', [CityController::class, 'weatherByCity']);// GET /widget/actirovki/cities/{city}/weathers
            Route::get('latest-weather', [CityController::class, 'latestWeatherByCity']);// GET /widget/actirovki/cities/{city}/weathers

            // Диапазоны погоды для актироовок
            Route::get('weather-ranges', [CityController::class, 'weatherRangesByCity']); // GET /widget/actirovki/cities/{city}/weather-ranges

            // Актировки
            Route::get('actirovki/today', [CityController::class, 'fetchActirovkiToday']);  // GET /widget/actirovki/cities/{city}/actirovki/today
            Route::get('actirovki/specific-day', [CityController::class, 'fetchActirovkiForSpecificDay']);  // GET /widget/actirovki/cities/{city}/actirovki/specific-day
        });
    });

    Route::get('rows', [RowController::class, 'index']);
    Route::get('weathers', [WeatherController::class, 'index']);
    Route::get('weather-ranges', [WeatherRangeController::class, 'index']);
});
