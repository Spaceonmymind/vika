<?php

namespace Modules\PhoneBookWidget\Models;

use Modules\PhoneBookWidget\Models\Base\OdDataset as BaseOdDataset;

class OdDataset extends BaseOdDataset
{
	protected $fillable = [
		'url',
		'data_type',
		'class_handler',
		'last_update',
		'description',
		'need_update',
		'is_active',
		'current_hash'
	];
}
