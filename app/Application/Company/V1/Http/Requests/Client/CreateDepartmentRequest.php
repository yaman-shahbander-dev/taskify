<?php

namespace App\Application\Company\V1\Http\Requests\Client;

use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;
use App\Application\Company\V1\Rules\OwnsCompany;

class CreateDepartmentRequest extends BaseRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => [
                'required',
                'uuid',
                Rule::exists('companies', 'id'),
                new OwnsCompany(),
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('company_departments', 'name')
            ],
            'team_name' => [
                'nullable',
                'string',
                'min:2',
                'max:255'
            ],
        ];
    }
}
