<?php

namespace Modules\BusinessSupportWidget\OpenDataHandlers;

use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetOdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, BusinessSupportWidgetOdDataset $dataset):bool;
}
