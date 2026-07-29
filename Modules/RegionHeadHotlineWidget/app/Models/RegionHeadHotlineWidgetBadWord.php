<?php

namespace Modules\RegionHeadHotlineWidget\Models;

use Modules\RegionHeadHotlineWidget\Models\Base\RegionHeadHotlineWidgetBadWord as BaseRegionHeadHotlineWidgetBadWord;

class RegionHeadHotlineWidgetBadWord extends BaseRegionHeadHotlineWidgetBadWord
{
	protected $fillable = [
		'word',
		'pattern'
	];
}
