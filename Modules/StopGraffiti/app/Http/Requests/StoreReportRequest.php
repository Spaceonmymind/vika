<?php

namespace Modules\StopGraffiti\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'string', 'max:64'],
            'createdAt' => ['required', 'date'],
            'userId' => ['required', 'integer'],
            'recipientId' => ['required', 'integer'],
            'recipientIsChat' => ['required', 'boolean'],
            'category' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:2000'],
            'comment' => ['nullable', 'string', 'max:5000'],
            'media' => ['present', 'array', 'max:20'],
            'media.*.type' => ['required', 'string', 'in:image,video,file'],
            'media.*.payloadJson' => ['required', 'json', 'max:100000'],
        ];
    }

    public function messages(): array
    {
        return [
            'media.*.payloadJson.json' => 'MAX media payload must contain valid JSON.',
        ];
    }
}
