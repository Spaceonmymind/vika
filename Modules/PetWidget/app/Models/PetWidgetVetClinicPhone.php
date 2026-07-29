<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetClinicPhone as BasePetWidgetVetClinicPhone;

class PetWidgetVetClinicPhone extends BasePetWidgetVetClinicPhone
{
	protected $fillable = [
		'phone',
		'clinic_id'
	];
}
