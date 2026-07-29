<?php

namespace Modules\ActirovkiWidget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ActirovkiWidget\Models\City;
use Modules\ActirovkiWidget\Models\Weather;
use Modules\ActirovkiWidget\Models\WeatherRange;

class StoreRowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city_id' => ['required', 'integer', Rule::exists(City::class, 'id'),],
            'weather_id' => ['required', 'integer', Rule::exists(Weather::class, 'id'),],
            'weather_range_id' => ['required', 'integer', Rule::exists(WeatherRange::class, 'id'),],
            'school_shift' => ['required', 'integer', Rule::in([1, 2]),],
        ];
    }
}
