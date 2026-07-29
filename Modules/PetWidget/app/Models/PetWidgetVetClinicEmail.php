<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetClinicEmail as BasePetWidgetVetClinicEmail;

class PetWidgetVetClinicEmail extends BasePetWidgetVetClinicEmail
{
	protected $fillable = [
		'email',
		'clinic_id'
	];
}
