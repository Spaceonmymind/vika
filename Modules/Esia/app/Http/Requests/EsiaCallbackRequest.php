<?php

namespace Modules\Esia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EsiaCallbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket' => ['required', 'string', 'max:128'],
        ];
    }
}
