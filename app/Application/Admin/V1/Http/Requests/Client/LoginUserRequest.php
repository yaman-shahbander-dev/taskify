<?php

namespace App\Application\Admin\V1\Http\Requests\Client;

use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;

class LoginUserRequest extends BaseRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'string'],
        ];
    }
}
