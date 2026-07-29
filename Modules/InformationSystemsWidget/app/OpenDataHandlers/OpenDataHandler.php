<?php

namespace Modules\InformationSystemsWidget\OpenDataHandlers;

use Modules\InformationSystemsWidget\Models\OdDataset;

interface OpenDataHandler
{
    public static function handle(object $data, OdDataset $dataset);
}
