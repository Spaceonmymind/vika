<?php

namespace Modules\HumanitarianPointsWidget\Models;

use Modules\HumanitarianPointsWidget\Models\Base\HumanitarianPointsWidgetHumanitarianPoint as BaseHumanitarianPointsWidgetHumanitarianPoint;

class HumanitarianPointsWidgetHumanitarianPoint extends BaseHumanitarianPointsWidgetHumanitarianPoint
{
	protected $fillable = [
        'id',
		'name',
		'address',
		'contact_person_fio',
		'contact_person_email',
		'contact_person_phone',
		'municipality_id'
	];
}
