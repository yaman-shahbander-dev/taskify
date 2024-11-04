<?php

namespace App\Application\Company\V1\Http\Requests\Client;

use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;
use App\Application\Company\V1\Rules\OwnsCompany;

class UpdateDepartmentRequest extends BaseRequest
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
                Rule::unique('company_departments', 'name')
                    ->ignore($this->department?->id, 'id')
            ],
            'team_name' => [
                'required_with:team_id',
                'string',
                'min:2',
                'max:255'
            ],
            'team_id' => [
                'required_with:team_name',
                'string',
                Rule::exists('departments_teams', 'id')
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->department->id]);
    }
}
