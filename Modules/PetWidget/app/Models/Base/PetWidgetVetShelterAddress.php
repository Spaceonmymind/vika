<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PetWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PetWidget\Models\PetWidgetVetShelter;

/**
 * Class PetWidgetVetShelterAddress
 *
 * @property int $id
 * @property string $address
 * @property int $shelter_id
 *
 * @property \Modules\PetWidget\Models\Base\PetWidgetVetShelter $pet_widget_vet_shelter
 *
 * @package App\Models\Base
 */
class PetWidgetVetShelterAddress extends Model
{
	protected $table = 'pet_widget_vet_shelter_addresses';
	public $timestamps = false;

	protected $casts = [
		'shelter_id' => 'int'
	];

	public function pet_widget_vet_shelter():BelongsTo
	{
		return $this->belongsTo(PetWidgetVetShelter::class, 'shelter_id');
	}
}
