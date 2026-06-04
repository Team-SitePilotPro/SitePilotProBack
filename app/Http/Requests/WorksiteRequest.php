<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class WorksiteRequest extends FormRequest
{
    /**
     * @return array<string, array|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            'client_id' => [
                'required',
                'integer',
                'exists:clients,id',
            ],
            'name_worksite' => [
                'nullable',
                'string',
                'min:2',
                'max:55',
            ],
            'description' => [
                'nullable',
                'string',
                'min:2',
                'max:255',
            ],
            'start_date' => [
                'nullable',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
            ],
            'worksite_priority' => [
                'required',
                Rule::enum(WorksitePriority::class),
            ],
            'worksite_status' => [
                'required',
                Rule::enum(WorksiteStatus::class),
            ],
            'street' => [
                'nullable',
                'string',
                'max:55',
            ],
            'city' => [
                'nullable',
                'string',
                'max:25',
            ],
            'zip_code' => [
                'nullable',
                'integer',
            ],
            'country' => [
                'nullable',
                'string',
                'max:25',
            ],
        ];
    }

    /**
     * @return array<string,string>
     */
    #[Override]
    public function attributes(): array
    {
        return [
            'client_id' => 'Client',
            'name' => 'Le nom du chantier',
            'description' => 'Description',
            'start_date' => 'Date prévu de début',
            'end_date' => 'Date prévu de fin ',
            'priority' => 'Priorité',
            'status' => 'WorksiteStatus',
            'street' => 'Rue',
            'city' => 'Ville',
            'zip_code' => 'Code postal',
            'country' => 'Pays',
        ];
    }
}
