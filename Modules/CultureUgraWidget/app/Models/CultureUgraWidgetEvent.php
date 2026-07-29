<?php

namespace Modules\CultureUgraWidget\Models;

use Modules\CultureUgraWidget\Models\Base\CultureUgraWidgetEvent as BaseCultureUgraWidgetEvent;

class CultureUgraWidgetEvent extends BaseCultureUgraWidgetEvent
{
	protected $fillable = [
        'id',
		'name',
		'locality_id',
		'description',
		'start_date',
		'end_date',
		'organization_name',
		'address',
		'buy_link',
		'buy_text'
	];
}
