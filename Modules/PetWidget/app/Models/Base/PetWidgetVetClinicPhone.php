<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PetWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PetWidget\Models\PetWidgetVetClinic;

/**
 * Class PetWidgetVetClinicPhone
 *
 * @property int $id
 * @property string $phone
 * @property int $clinic_id
 *
 * @property \Modules\PetWidget\Models\Base\PetWidgetVetClinic $pet_widget_vet_clinic
 *
 * @package App\Models\Base
 */
class PetWidgetVetClinicPhone extends Model
{
	protected $table = 'pet_widget_vet_clinic_phones';
	public $timestamps = false;

	protected $casts = [
		'clinic_id' => 'int'
	];

	public function pet_widget_vet_clinic():BelongsTo
	{
		return $this->belongsTo(PetWidgetVetClinic::class, 'clinic_id');
	}
}
