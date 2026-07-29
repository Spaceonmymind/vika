<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetOdDataset as BaseDistrictSearchWidgetOdDataset;

class DistrictSearchWidgetOdDataset extends BaseDistrictSearchWidgetOdDataset
{
	protected $fillable = [
		'url',
		'data_type',
		'class_handler',
		'description',
		'need_update',
		'is_active',
		'current_hash',
		'dataset_type_id'
	];
}
