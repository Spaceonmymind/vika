<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PetWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PetWidget\Models\PetWidgetLocality;

/**
 * Class PetWidgetVetArea
 *
 * @property int $id
 * @property string $address
 * @property int $locality_id
 *
 * @property PetWidgetLocality $pet_widget_locality
 *
 * @package App\Models\Base
 */
class PetWidgetVetArea extends Model
{
	protected $table = 'pet_widget_vet_areas';
	public $timestamps = false;

	protected $casts = [
		'locality_id' => 'int'
	];

	public function pet_widget_locality():BelongsTo
	{
		return $this->belongsTo(PetWidgetLocality::class, 'locality_id');
	}
}
