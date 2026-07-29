<?php

namespace Modules\KMNSSupportWidget\Models;

use Modules\KMNSSupportWidget\Models\Base\KmnsSupportWidgetOdDataset as BaseKmnsSupportWidgetOdDataset;

class KmnsSupportWidgetOdDataset extends BaseKmnsSupportWidgetOdDataset
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
