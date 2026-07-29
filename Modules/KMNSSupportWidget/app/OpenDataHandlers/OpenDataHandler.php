<?php

namespace Modules\KMNSSupportWidget\OpenDataHandlers;


use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;
use Modules\KMNSSupportWidget\Models\KmnsSupportWidgetOdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, KmnsSupportWidgetOdDataset $dataset):bool;
}
