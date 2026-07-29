<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDoctor;

/**
 * Class DistrictSearchWidgetDoctorTimetableRecord
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $day_number
 * @property bool $odd_week
 * @property bool $is_break
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDoctor $district_search_widget_doctor
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetDoctorTimetableRecord extends Model
{
	protected $table = 'district_search_widget_doctor_timetable_records';
	public $timestamps = false;

	protected $casts = [
		'doctor_id' => 'int',
		'day_number' => 'int',
		'odd_week' => 'bool',
		'is_break' => 'bool'
	];

	public function district_search_widget_doctor()
	{
		return $this->belongsTo(DistrictSearchWidgetDoctor::class, 'doctor_id');
	}
}
