<?php

namespace Modules\DistrictSearchWidget\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\DistrictSearchWidget\Models\Base\DistrictSearchWidgetHospital as BaseDistrictSearchWidgetHospital;

class DistrictSearchWidgetHospital extends BaseDistrictSearchWidgetHospital
{
	protected $fillable = [
		'name',
		'address',
		'site',
		'email',
		'phone',
        'city_id',
        'created_from_doctors_dataset'
	];
    public function city ():BelongsTo
    {
        return  $this->belongsTo(DistrictSearchWidgetCity::class, 'city_id');
    }
}
