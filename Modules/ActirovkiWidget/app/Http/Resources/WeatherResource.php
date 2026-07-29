<?php

namespace Modules\ActirovkiWidget\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActirovkiWidget\Models\Weather;

/** @mixin Weather */
class WeatherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'temperature' => $this->temperature,
            'wind' => $this->wind,
            'created_at' => $this->created_at,
            'received_at' => $this->received_at,
        ];
    }
}
