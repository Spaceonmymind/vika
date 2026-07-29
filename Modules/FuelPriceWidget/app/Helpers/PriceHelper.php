<?php

namespace Modules\FuelPriceWidget\Helpers;

class PriceHelper
{
    /**
     * Преобразует строку во float до двух цифр после запятой, либо вернёт null
     * @param $value
     * @return float|null
     */
    public static function preparePrice($value): ?float
    {
        return is_numeric($value) ? round((float)$value, 2) : null;
    }
}
