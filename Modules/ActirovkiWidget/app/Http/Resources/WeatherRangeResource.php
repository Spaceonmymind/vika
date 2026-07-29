<?php

namespace Modules\ActirovkiWidget\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActirovkiWidget\Models\WeatherRange;

/** @mixin WeatherRange */
class WeatherRangeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'wind' => $this->wind,
            'temperature' => $this->temperature,
            'school_class' => $this->school_class,
            'id' => $this->id,
            'city_id' => $this->city_id,
        ];
    }
}
