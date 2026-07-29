<?php

namespace Modules\PetWidget\Models;

use Modules\PetWidget\Models\Base\PetWidgetVetArea as BasePetWidgetVetArea;

class PetWidgetVetArea extends BasePetWidgetVetArea
{
	protected $fillable = [
		'address',
		'locality_id'
	];
}
