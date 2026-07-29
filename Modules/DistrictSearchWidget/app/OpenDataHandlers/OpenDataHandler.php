<?php

namespace Modules\DistrictSearchWidget\OpenDataHandlers;

use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetOdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, DistrictSearchWidgetOdDataset $dataset);
}
