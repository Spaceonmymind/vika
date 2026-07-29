<?php

namespace Modules\ITSupportWidget\Models;

use Modules\ITSupportWidget\Models\Base\ItSupportWidgetOdDataset as BaseItSupportWidgetOdDataset;

class ItSupportWidgetOdDataset extends BaseItSupportWidgetOdDataset
{
	protected $fillable = [
		'url',
		'data_type',
		'class_handler',
		'description',
		'need_update',
		'is_active',
		'current_hash',
		'last_update'
	];
}
