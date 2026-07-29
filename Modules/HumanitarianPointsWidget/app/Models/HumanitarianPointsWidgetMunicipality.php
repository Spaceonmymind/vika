<?php

namespace Modules\HumanitarianPointsWidget\Models;

use Modules\HumanitarianPointsWidget\Models\Base\HumanitarianPointsWidgetMunicipality as BaseHumanitarianPointsWidgetMunicipality;

class HumanitarianPointsWidgetMunicipality extends BaseHumanitarianPointsWidgetMunicipality
{
	protected $fillable = [
        'id',
		'name'
	];
}
