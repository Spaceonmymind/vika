<?php

namespace Modules\ActirovkiWidget\Helpers;

use DateTimeInterface;

final class AktovkaMessageFormatter
{
    private const string DATE_FORMAT = 'd.m.Y';

    public static function timeNotReached(int $shift): string
    {
        $timeString = match ($shift) {
            1 => '06:00',
            2 => '11:40',
            default => 'ближайшее время',
        };
        return "Время объявления актировки для смены $shift еще не наступило. Информация появится в $timeString.";
    }

    public static function notAnnounced(
        int               $shift,
        DateTimeInterface $date,
        string            $announceTime
    ): string
    {
        $day = $date->format(self::DATE_FORMAT);

        return "$day на $announceTime температурные условия не превышают пороговых для объявления актировки {$shift}-й смены.";
    }

    public static function announced(
        int               $shift,
        DateTimeInterface $date,
        int               $schoolClass
    ): string
    {
        $day = $date->format(self::DATE_FORMAT);

        return "{$day} занятия {$shift}-й смены с 1 по $schoolClass класс отменяются.";
    }

    public static function announcedWithTempAndWind(?int $schoolShift, $date, $cityName, $temperature, $windSpeed, int $maxClass): string
    {
        $template = ':date в :city занятия :shift-й смены с 1 по :max-class класс отменяются. На момент объявления: температура :temp°, ветер :wind м/с.';

        return strtr($template, [
            ':date' => $date->format('d.m.Y'),
            ':city' => $cityName,
            ':shift' => $schoolShift,
            ':max-class' => $maxClass,
            ':temp' => (string)$temperature,
            ':wind' => (string)$windSpeed,
        ]);
    }
}
