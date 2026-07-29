<?php

namespace Modules\HumanitarianPointsWidget\Models;

use Modules\HumanitarianPointsWidget\Models\Base\HumanitarianPointsWidgetToken as BaseHumanitarianPointsWidgetToken;

class HumanitarianPointsWidgetToken extends BaseHumanitarianPointsWidgetToken
{

	protected $fillable = [
		'token',
		'valid_to'
	];
}
