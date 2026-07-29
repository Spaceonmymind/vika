<?php

namespace Modules\DistrictSearchWidget\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetDoctor as BaseDistrictSearchWidgetDoctor;

class DistrictSearchWidgetDoctor extends BaseDistrictSearchWidgetDoctor
{
	protected $fillable = [
		'last_name',
		'first_name',
		'middle_name',
		'phone',
		'district_id',
        'created_from_doctors_dataset',
	];
    public function odd_week_timetable_records():HasMany
    {
        return $this->hasMany(DistrictSearchWidgetDoctorTimetableRecord::class, 'doctor_id')->where('odd_week', true);
    }
    public function even_week_timetable_records():HasMany
    {
        return $this->hasMany(DistrictSearchWidgetDoctorTimetableRecord::class, 'doctor_id')->where('odd_week', false);
    }
}
