<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\BusinessSupportWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetMunicipality;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetRegistrationPlace;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSituation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSubject;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportOrganisation;
use Modules\BusinessSupportWidget\Models\BusinessSupportWidgetSupportType;

/**
 * Class BusinessSupportWidgetMeasure
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $conditions
 * @property string|null $activities
 * @property string|null $financial_support
 * @property string|null $terms
 * @property string|null $law
 * @property string|null $revenue_year
 * @property string|null $company_age
 * @property string|null $documents
 * @property string|null $date_receipt_documents
 * @property string|null $employees
 * @property string|null $contacts
 * @property int|null $situation_id
 * @property int|null $subject_id
 * @property int|null $registration_place_id
 * @property int|null $support_organisation_id
 * @property int|null $support_type_id
 * @property int $municipality_id
 *
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetMunicipality $business_support_widget_municipality
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetRegistrationPlace|null $business_support_widget_registration_place
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetSituation|null $business_support_widget_situation
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetSubject|null $business_support_widget_subject
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetSupportOrganisation|null $business_support_widget_support_organisation
 * @property \Modules\BusinessSupportWidget\Models\Base\BusinessSupportWidgetSupportType|null $business_support_widget_support_type
 *
 * @package App\Models\Base
 */
class BusinessSupportWidgetMeasure extends Model
{
	protected $table = 'business_support_widget_measures';
	public $timestamps = false;

	protected $casts = [
		'situation_id' => 'int',
		'subject_id' => 'int',
		'registration_place_id' => 'int',
		'support_organisation_id' => 'int',
		'support_type_id' => 'int',
		'municipality_id' => 'int'
	];

	public function business_support_widget_municipality():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetMunicipality::class, 'municipality_id');
	}

	public function business_support_widget_registration_place():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetRegistrationPlace::class, 'registration_place_id');
	}

	public function business_support_widget_situation():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetSituation::class, 'situation_id');
	}

	public function business_support_widget_subject():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetSubject::class, 'subject_id');
	}

	public function business_support_widget_support_organisation():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetSupportOrganisation::class, 'support_organisation_id');
	}

	public function business_support_widget_support_type():BelongsTo
	{
		return $this->belongsTo(BusinessSupportWidgetSupportType::class, 'support_type_id');
	}
}
