<?php

namespace App\Application\Company\V1\Http\Requests\Client;

use App\Application\Company\V1\Rules\OwnsDepartment;
use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;

class CreateTeamRequest extends BaseRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => [
                'required',
                'uuid',
                Rule::exists('company_departments', 'id'),
                new OwnsDepartment(),
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],
        ];
    }
}
