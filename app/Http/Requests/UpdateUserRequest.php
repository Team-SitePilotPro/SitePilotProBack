<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['sometimes', 'required', 'string', 'max:255'],
            'last_name'  => ['sometimes', 'required', 'string', 'max:255'],
            'email'      => [
                'sometimes', 'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'phone'    => ['sometimes', 'required', 'string', 'max:20'],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['sometimes', 'required', 'string'],
            'userRole' => ['sometimes', 'required', new Enum(UserRole::class)],
        ];
    }
}
