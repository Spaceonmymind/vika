<?php

namespace Modules\DistrictSearchWidget\Models;

use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDoctorTimetableRecord as BaseDistrictSearchWidgetDoctorTimetableRecord;

class DistrictSearchWidgetDoctorTimetableRecord extends BaseDistrictSearchWidgetDoctorTimetableRecord
{
	protected $fillable = [
		'doctor_id',
		'day_number',
		'odd_week',
        'time',
        'break_time'
	];
}
