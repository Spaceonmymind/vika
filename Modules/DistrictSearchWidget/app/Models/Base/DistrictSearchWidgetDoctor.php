<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\DistrictSearchWidget\Models\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDistrict;
use Modules\DistrictSearchWidget\Models\DistrictSearchWidgetDoctorTimetableRecord;

/**
 * Class DistrictSearchWidgetDoctor
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $phone
 * @property int $district_search_widget_id
 *
 * @property \Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDistrict $district_search_widget_district
 * @property Collection|DistrictSearchWidgetDoctorTimetableRecord[] $district_search_widget_doctor_timetable_records
 *
 * @package App\Modules\DistrictSearchWidget\Models\Base
 */
class DistrictSearchWidgetDoctor extends Model
{
	protected $table = 'district_search_widget_doctors';
	public $timestamps = false;

	protected $casts = [
		'district_id' => 'int',
		'created_from_doctors_dataset' => 'boolean'
	];

	public function district_search_widget_district()
	{
		return $this->belongsTo(DistrictSearchWidgetDistrict::class, 'district_id');
	}

	public function district_search_widget_doctor_timetable_records()
	{
		return $this->hasMany(DistrictSearchWidgetDoctorTimetableRecord::class, 'doctor_id');
	}
}
