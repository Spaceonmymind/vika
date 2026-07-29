<?php

namespace Modules\ActirovkiWidget\Console;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Modules\ActirovkiWidget\Helpers\ModuleLog;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Services\ActirovkiService;

class GetWeatherFromUgrameteo extends Command
{
    protected $signature = 'weather:get
     {--school_shift= : Смена в школе (1 или 2)}';
    protected $description = 'Получить погодные данные из Ugrameteo для виджета Актировок';

    /**
     * @throws ConnectionException
     */
    public function handle(ActirovkiService $service): void
    {
        $schoolShift = (int)$this->option('school_shift');

        if ($schoolShift !== 1 && $schoolShift !== 2) {
            $this->error('Аргумент school_shift должен быть равен 1 или 2');
            return;
        }

        $response = Http::withBasicAuth(config('services.ugrameteo.login'), config('services.ugrameteo.password'))
            ->get(config('services.ugrameteo.url'));

        if (!$response->successful()) {
            ModuleLog::moduleAndTelegram()->error('Ошибка при получении данных от ugrameteo.ru',
                [
                    'response' => $response,
                    'status_code' => $response->status(),
                    'class' => __CLASS__,
                ]);
            return;
        }

        $weathers = $response->json()['records'];

        ModuleLog::module()->info('Информация от ugrameteo.ru', $weathers);

        $counterOfCitiesWithTemperatureBelowMinus24 = 0;
        $counterActirovkaCreated = 0;
        foreach ($weathers as $weather) {
            // Если нет информации о погоде
            if (empty($weather['ta'])) {
                continue;
            }

            $city = City::whereFiasId($weather['fias'] ?? '')->first();

            if (!($city instanceof City)) {
                ModuleLog::moduleAndTelegram()->error("Ошибка при получении данных от ugrameteo.ru. Неизвестный ФИАС ID: {$weather['fias']}",
                    [
                        'response' => $weather,
                        'status_code' => $response->status(),
                        'class' => __CLASS__,
                    ]);
                continue;
            }

            $weather = Weather::query()->create([
                'city_id' => $city->id,
                'temperature' => (float)$weather['ta'],
                'wind' => (float)$weather['wp'],
            ]);

            $actirovka = $service->processWeather($weather);

            if ($actirovka !== null) {
                $counterActirovkaCreated++;
            }

            $counterOfCitiesWithTemperatureBelowMinus24++;
        }

        ModuleLog::moduleAndTelegram()->info('Успешный запрос погоды с ugrameteo.ru. Количество городов с температурой ниже -24 градусов : ' . $counterOfCitiesWithTemperatureBelowMinus24 .
            '. Количество созданных актировок: ' . $counterActirovkaCreated,
            [
                'status_code' => $response->status(),
            ]);
    }
}
