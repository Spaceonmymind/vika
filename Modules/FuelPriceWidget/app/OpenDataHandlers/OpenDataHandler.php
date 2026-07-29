<?php

namespace Modules\FuelPriceWidget\OpenDataHandlers;

use Modules\FuelPriceWidget\Models\OdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, OdDataset $dataset);
}
