<?php

namespace Modules\ITSupportWidget\OpenDataHandlers;


use Modules\ITSupportWidget\Models\ItSupportWidgetOdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, ItSupportWidgetOdDataset $dataset):bool;
}
