<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorksiteRequest extends FormRequest
{
    // Authorize all authenticated users to make this request.
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules for worksite creation and update.
    /** @return array<string, ValidationRule|array|string> */
    public function rules(): array
    {
        return [
            'client_id'          => ['required', 'integer', 'exists:clients,id'],
            'name_worksite'      => ['required', 'string', 'min:2', 'max:255'],
            'description'        => ['nullable', 'string', 'min:2', 'max:255'],
            'start_date'         => ['nullable', 'date'],
            'end_date'           => ['nullable', 'date', 'after_or_equal:start_date'],
            'worksite_priority'  => ['required', Rule::enum(WorksitePriority::class)],
            'worksite_status'    => ['required', Rule::enum(WorksiteStatus::class)],
            'street'             => ['nullable', 'string', 'max:255'],
            'city'               => ['nullable', 'string', 'max:100'],
            'zip_code'           => ['nullable', 'integer'],
            'country'            => ['nullable', 'string', 'max:100'],
        ];
    }

    // Human-readable attribute names used in validation messages.
    /** @return array<string,string> */
    public function attributes(): array
    {
        return [
            'client_id'         => 'Client',
            'name_worksite'     => 'Worksite name',
            'description'       => 'Description',
            'start_date'        => 'Start date',
            'end_date'          => 'End date',
            'worksite_priority' => 'Priority',
            'worksite_status'   => 'Status',
            'street'            => 'Street',
            'city'              => 'City',
            'zip_code'          => 'Zip code',
            'country'           => 'Country',
        ];
    }
}
