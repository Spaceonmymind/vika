<?php

namespace Modules\SocialSupportWidget\OpenDataHandlers;

use Modules\SocialSupportWidget\Models\SocialSupportWidgetOdDataset;

interface OpenDataHandler
{
    public static function handle(array $data, SocialSupportWidgetOdDataset $dataset);
}
