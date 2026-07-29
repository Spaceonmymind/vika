<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\HumanitarianPointsWidget\Models\Base;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\HumanitarianPointsWidget\Models\HumanitarianPointsWidgetMunicipality;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HumanitarianPointsWidgetHumanitarianPoint
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $contact_person_fio
 * @property string|null $contact_person_email
 * @property string|null $contact_person_phone
 * @property int $municipality_id
 *
 * @property HumanitarianPointsWidgetMunicipality $municipality
 *
 * @package Modules\HumanitarianPointsWidget\Models\Base
 */
class HumanitarianPointsWidgetHumanitarianPoint extends Model
{
	protected $table = 'humanitarian_points_widget_humanitarian_points';
	public $timestamps = false;

	protected $casts = [
		'municipality_id' => 'int'
	];

	public function municipality():BelongsTo
	{
		return $this->belongsTo(HumanitarianPointsWidgetMunicipality::class, 'municipality_id');
	}
}
