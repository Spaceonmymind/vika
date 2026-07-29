<?php

namespace Modules\PetWidget\Services;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\PetWidget\Models\PetWidgetLocality;

class VetAreaService
{
    public function getAreas($localityId = null) {
        return PetWidgetLocality::query()
            ->with([
                'pet_widget_vet_areas',
            ])
            ->when(isset($localityId),function (Builder $q)use ($localityId){
                $q->where('id',$localityId);
            })
            ->get();
    }
}
