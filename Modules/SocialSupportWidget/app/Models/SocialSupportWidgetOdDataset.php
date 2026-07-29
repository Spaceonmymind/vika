<?php

namespace Modules\SocialSupportWidget\Models;

use Modules\SocialSupportWidget\Models\Base\SocialSupportWidgetOdDataset as BaseSocialSupportWidgetOdDataset;

class SocialSupportWidgetOdDataset extends BaseSocialSupportWidgetOdDataset
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
