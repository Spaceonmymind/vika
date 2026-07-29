<?php

namespace Modules\PhoneBookWidget\OpenDataHandlers;

use Modules\PhoneBookWidget\Models\OdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, OdDataset $dataset);
}
