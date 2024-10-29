<?php

namespace App\Application\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'contact_number' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/']
        ];
    }
}