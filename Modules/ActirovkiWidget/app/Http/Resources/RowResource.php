<?php

namespace Modules\ActirovkiWidget\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActirovkiWidget\Models\Row;

/** @mixin Row */
class RowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'weather_id' => $this->weather_id,
            'weather_range_id' => $this->weather_range_id,
            'school_shift' => $this->school_shift,
            'weather' => new WeatherResource($this->whenLoaded('weather')),
            'weather_range' => new WeatherRangeResource($this->whenLoaded('weather_range')),
            $this->mergeWhen(
                $request->user()?->hasPermissionTo('actirovki')
                && array_key_exists('cancel_user_id', $this->resource->getAttributes()),
                [
                    'cancel_user_id' => $this->whenHas('cancel_user_id'),
                    'cancel_user' => new UserResource($this->whenLoaded('cancel_user')),
                    'cancel_at' => $this->whenHas('cancel_at'),
                    'send_at' => $this->whenHas('send_at'),
                    'created_at' => $this->whenHas('created_at'),
                ]
            ),
        ];
    }
}
