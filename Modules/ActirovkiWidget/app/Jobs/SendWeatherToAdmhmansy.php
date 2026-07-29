<?php

namespace Modules\ActirovkiWidget\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Modules\ActirovkiWidget\Helpers\AktovkaMessageFormatter;
use Modules\ActirovkiWidget\Helpers\ModuleLog;
use Modules\ActirovkiWidget\Models\City;

class SendWeatherToAdmhmansy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $url;
    private string $key;
    protected const string KHANTY_MANSY_FIAS_ID = 'd680d1a9-ff89-42c0-b39f-143d2ffb520a';
    private int $schoolShift;

    /**
     * Create a new job instance.
     */
    public function __construct(int $schoolShift)
    {
        $this->schoolShift = $schoolShift;

        $this->url = config('services.admhmansy.weather_api_url');
        $this->key = config('services.admhmansy.weather_api_token');
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $currentShift = $this->schoolShift;
        // Берём города, у которых есть актировка сегодня и она относится к текущей смене
        $khanty = City::with([
            'latestActirovkiWidgetRow.weather',
            'latestActirovkiWidgetRow.weather_range'
        ])
            ->where('fias_id', static::KHANTY_MANSY_FIAS_ID)
            ->whereHas('latestActirovkiWidgetRow', function ($q) use ($currentShift) {
                $q->where('school_shift', $currentShift);
            })
            ->first();

        if ($khanty !== null) {
            $message = AktovkaMessageFormatter::announcedWithTempAndWind(
                $khanty->latestActirovkiWidgetRow->school_shift ?? null,
                $khanty->latestActirovkiWidgetRow->created_at,
                $khanty->name,
                $khanty->latestActirovkiWidgetRow->weather->temperature ?? null,
                $khanty->latestActirovkiWidgetRow->weather->wind ?? null,
                $khanty->latestActirovkiWidgetRow->weather_range->school_class ?? null,
            );

            $params = [
                'action' => 'sendActirovka',
                'key' => $this->key,
                'text' => $message,
            ];

            $response = Http::get($this->url, $params);

            if (!$response->successful()) {
                ModuleLog::moduleAndTelegram()->error('Ошибка при отправке данных об актировке на admhmansy',
                    [
                        'response' => $response,
                        'class' => __CLASS__
                    ]);
            }
        }
    }
}
