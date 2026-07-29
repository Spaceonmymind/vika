<?php

namespace Modules\RegionHeadHotlineWidget\Models;

use Modules\RegionHeadHotlineWidget\Models\Base\RegionHeadHotlineWidgetAppeal as BaseRegionHeadHotlineWidgetAppeal;

class RegionHeadHotlineWidgetAppeal extends BaseRegionHeadHotlineWidgetAppeal
{
	protected $fillable = [
		'max_user_id',
		'external_id',
        'appeal_number'
	];
}
