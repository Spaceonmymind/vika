<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetClinicAddress as BasePetWidgetVetClinicAddress;

class PetWidgetVetClinicAddress extends BasePetWidgetVetClinicAddress
{
	protected $fillable = [
		'address',
		'clinic_id'
	];
}
