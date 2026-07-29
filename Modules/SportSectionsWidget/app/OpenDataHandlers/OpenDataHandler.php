<?php

namespace Modules\SportSectionsWidget\OpenDataHandlers;


use Modules\SportSectionsWidget\Models\OdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, OdDataset $dataset);
}
