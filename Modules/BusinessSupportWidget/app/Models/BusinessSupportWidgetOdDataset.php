<?php

namespace Modules\BusinessSupportWidget\Models;

use Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetOdDataset as BaseBusinessSupportWidgetOdDataset;

class BusinessSupportWidgetOdDataset extends BaseBusinessSupportWidgetOdDataset
{
	protected $fillable = [
		'url',
		'data_type',
		'class_handler',
		'description',
		'need_update',
		'is_active',
		'current_hash',
		'last_update',
		'municipality_id'
	];
}
