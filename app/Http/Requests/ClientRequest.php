<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\ClientType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int,Enum|string>>
     */
    public function rules(): array
    {
        return [
            'contact_name' => [
                'required',
                'string',
                'max:255',
            ],

            'private_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients', 'email')->ignore($this->route('client')),
            ],

            'company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'street' => [
                'required',
                'string',
                'max:255',
            ],

            'city' => [
                'required',
                'string',
                'max:255',
            ],

            'zip_code' => [
                'required',
                'integer',
            ],

            'country' => [
                'required',
                'string',
                'max:255',
            ],

            'client_type' => [
                'required',
                new Enum(ClientType::class),
            ],

            'siret' => [
                'required',
                'string',
                'max:14',
            ],

            'tva_intra' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
