<?php

namespace Modules\ActirovkiWidget\Services;

use Carbon\CarbonImmutable;
use Modules\ActirovkiWidget\Dto\ActirovkaDto;
use Modules\ActirovkiWidget\Helpers\AktovkaMessageFormatter;
use Modules\ActirovkiWidget\Models\Row;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Models\WeatherRange;

class ActirovkiService
{
    // Время объявления актировки для отображения в публичном API
    protected array $schoolShiftsPublicAccess = [
        1 => '06:00', // Время объявления актировки для первой смены
        2 => '11:40', // Время объявления актировки для второй смены
    ];

    // Реальное время объявления актировок
    protected array $schoolShiftsPrivateAccess = [
        1 => '00:00', // Время объявления актировки для первой смены
        2 => '11:00', // Время объявления актировки для второй смены
    ];

    /**
     * Получить информацию об актировках для первой и второй смен за текущую дату
     *
     * @param int $cityId
     * @return ActirovkaDto[]
     */
    public function fetchActirovkiToday(int $cityId): array
    {
        return $this->fetchActirovkiByDate($cityId, CarbonImmutable::now(), true);
    }

    /**
     * Получить информацию об актировках для первой и второй смен за указанную дату
     *
     * @param int $cityId
     * @param CarbonImmutable $date
     * @param bool $validateAnnouncementTime
     * @return ActirovkaDto[]
     */
    public function fetchActirovkiByDate(
        int  $cityId,
        CarbonImmutable $date,
        bool $validateAnnouncementTime = false
    ): array
    {
        $results = [];

        $rows = Row::query()
            ->select(['id', 'city_id', 'weather_id', 'weather_range_id', 'school_shift'])
            ->with(['weather', 'weather_range'])
            ->where('city_id', $cityId)
            ->active()
            ->whereBetween('created_at', [$date->startOfDay(), $date->endOfDay()])
            ->get()
            ->keyBy('school_shift');

        foreach ($this->schoolShiftsPublicAccess as $schoolShift => $announceTime) {
            // Если время объявления еще не наступило
            if ($validateAnnouncementTime && $date->lt($announceTime)) {
                $results[] = ActirovkaDto::pending(
                    $schoolShift,
                    AktovkaMessageFormatter::timeNotReached($schoolShift)
                );
                continue;
            }
            /** @var Row|null $row */
            $row = $rows->get($schoolShift);

            if ($row) {
                $results[] = ActirovkaDto::announced(
                    $schoolShift,
                    AktovkaMessageFormatter::announced($schoolShift, $date, $row->weather_range->school_class),
                    $row
                );
            } else {
                $results[] = ActirovkaDto::notAnnounced(
                    $schoolShift,
                    AktovkaMessageFormatter::notAnnounced($schoolShift, $date, $announceTime)
                );
            }
        }

        return $results;
    }

    public function getCurrentSchoolShift(): int
    {
        $now = CarbonImmutable::now();

        $currentShift = null;

        foreach ($this->schoolShiftsPrivateAccess as $schoolShift => $announceTime) {
            if ($now->gt($announceTime)) {
                $currentShift = $schoolShift;
            } else {
                break;
            }
        }

        return $currentShift;
    }

    /**
     * Проверка погоды на наличие возможности объявления актировки
     * @param Weather $weather
     * @return Row|null
     */
    public function processWeather(Weather $weather): ?Row
    {
        $weatherRange = WeatherRange::matchingForWeather($weather);
        if ($weatherRange instanceof WeatherRange) {
            return Row::create([
                'city_id' => $weather->city_id,
                'weather_range_id' => $weatherRange->id,
                'weather_id' => $weather->id,
                'school_shift' => $this->getCurrentSchoolShift(),
            ]);
        }

        return null;
    }
}
