<?php

namespace Modules\KMNSSupportWidget\Models;

use Modules\KMNSSupportWidget\Models\Base\KmnsSupportWidgetMeasure as BaseKmnsSupportWidgetMeasure;

class KmnsSupportWidgetMeasure extends BaseKmnsSupportWidgetMeasure
{
	protected $fillable = [
		'name',
		'support_organisation',
		'subject',
		'terms',
		'apply_types',
		'get_result_types',
		'measure_result',
		'documents',
		'link',
		'activity_type_id'
	];
}
