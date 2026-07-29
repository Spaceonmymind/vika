<?php

namespace Modules\AppointmentToDoctorWidget\Models;

use Modules\AppointmentToDoctorWidget\Models\Base\AppointmentToDoctorMaxContact as BaseAppointmentToDoctorMaxContact;

class AppointmentToDoctorMaxContact extends BaseAppointmentToDoctorMaxContact
{
	protected $fillable = [
		'user_id',
		'phone',
		'last_name',
		'first_name',
		'middle_name'
	];
}
