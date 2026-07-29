<?php

namespace Modules\SocialSupportWidget\Models;

use Modules\SocialSupportWidget\Models\Base\SocialSupportWidgetSocialSupportMeasure as BaseSocialSupportWidgetSocialSupportMeasure;

class SocialSupportWidgetSocialSupportMeasure extends BaseSocialSupportWidgetSocialSupportMeasure
{
	protected $fillable = [
		'situation_id',
		'name',
		'conditions',
		'amount_and_deadlines',
		'law',
		'min_amount',
		'max_amount',
		'max_family_income',
		'min_child_age',
		'max_child_age',
		'live_in_ugra_years',
		'create_date',
		'update_date',
        'epgu_link',
	];
}
