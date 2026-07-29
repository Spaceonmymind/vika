<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetShelterEmail as BasePetWidgetVetShelterEmail;

class PetWidgetVetShelterEmail extends BasePetWidgetVetShelterEmail
{
	protected $fillable = [
		'email',
		'shelter_id'
	];
}
