<?php

namespace Modules\BusinessSupportWidget\Models;

use Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetMeasure as BaseBusinessSupportWidgetMeasure;

class BusinessSupportWidgetMeasure extends BaseBusinessSupportWidgetMeasure
{
	protected $fillable = [
		'name',
		'description',
		'conditions',
		'activities',
		'financial_support',
		'terms',
		'law',
		'revenue_year',
		'company_age',
		'documents',
		'date_receipt_documents',
		'employees',
		'contacts',
		'situation_id',
		'subject_id',
		'registration_place_id',
		'support_organisation_id',
		'support_type_id',
		'municipality_id'
	];
}
