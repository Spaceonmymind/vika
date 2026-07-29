<?php

namespace Modules\ActirovkiWidget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\ActirovkiWidget\Models\City;

class StoreCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'fias_id' => [
                'required',
                'string',
                'size:36',
                Rule::unique(City::class, 'fias_id')->ignore($this->route('city')?->fias_id, 'fias_id'),
            ],
            'reference_city_id' => [
                'sometimes',
                'integer',
                Rule::exists(City::class, 'id'),
            ]
        ];
    }
}
