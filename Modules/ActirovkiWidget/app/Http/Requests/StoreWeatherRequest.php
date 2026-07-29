<?php

namespace Modules\ActirovkiWidget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ActirovkiWidget\Models\City;

class StoreWeatherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city_id' => ['required', 'integer', Rule::exists(City::class, 'id')],
            'temperature' => ['required', 'numeric', 'between:-99.9,99.9'],
            'wind' => ['required', 'numeric', 'between:0,999.9']
        ];
    }
}
