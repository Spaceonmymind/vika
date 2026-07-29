<?php

namespace Modules\FuelPriceWidget\Helpers;

class CoordinatesHelper
{
    public static function prepareCoordinate($value)
    {
        // Регулярное выражение для проверки формата: 2 цифры перед точкой и 8 после
        $pattern = '/^\d{2}\.\d+$/';

        if (preg_match($pattern, $value)) {
            return $value;
        }
        return null;
    }
}
