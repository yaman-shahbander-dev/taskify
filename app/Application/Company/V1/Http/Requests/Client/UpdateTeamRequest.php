<?php

namespace App\Application\Company\V1\Http\Requests\Client;

use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;
use App\Application\Company\V1\Rules\OwnsDepartment;

class UpdateTeamRequest extends BaseRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
            'department_id' => [
                'required',
                'string',
                Rule::exists('company_departments', 'id'),
                new OwnsDepartment(),
            ]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->team->id]);
    }
}
