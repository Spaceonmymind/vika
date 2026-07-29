<?php

namespace Modules\RegionHeadHotlineWidget\Models;

use Modules\RegionHeadHotlineWidget\Models\Base\RegionHeadHotlineWidgetMaxContact as BaseRegionHeadHotlineWidgetMaxContact;

class RegionHeadHotlineWidgetMaxContact extends BaseRegionHeadHotlineWidgetMaxContact
{
	protected $fillable = [
		'user_id',
		'phone',
		'last_name',
		'first_name',
		'middle_name',
		'active'
	];
}
