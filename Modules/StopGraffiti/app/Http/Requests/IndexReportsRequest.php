<?php

namespace Modules\StopGraffiti\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\StopGraffiti\Enums\ReportStatus;

class IndexReportsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::enum(ReportStatus::class)],
            'category' => ['nullable', 'string', 'max:255'],
            'assigned_to' => ['nullable', 'integer', 'exists:users,id'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
