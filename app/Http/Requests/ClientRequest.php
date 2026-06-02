<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ClientRequest extends FormRequest
{
    // Autorise la requête.
    public function authorize(): bool
    {
        return true;
    }

    // Règles de validation des données client.
    /**
     * @return array<string, array<int,string|Enum>>
     */
    public function rules(): array
    {
        return [
            'contact_name' => [
                'required',
                'string',
                'max:255',
            ],

            'name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
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

            'type' => [
                'required',
                new Enum(Type::class),
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
