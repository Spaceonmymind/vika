<?php

namespace Modules\ActirovkiWidget\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchActirovkiByCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => 'required|date',
        ];
    }
}
