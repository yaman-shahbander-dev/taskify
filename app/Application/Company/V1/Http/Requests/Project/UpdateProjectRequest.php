<?php

namespace App\Application\Company\V1\Http\Requests\Project;

use App\Application\Company\V1\Rules\OwnsCompany;
use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;
use App\Application\Company\V1\Rules\OwnsDepartment;

class UpdateProjectRequest extends BaseRequest
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
                'max:255'
            ],
            'description' => [
                'required',
                'string',
                'min:1',
            ],
            'companies' => [
                'required',
                'array',
                'min:1',
                Rule::exists('companies', 'id'),
                new OwnsCompany(),
            ],
            'departments' => [
                'required',
                'array',
                'min:1',
                Rule::exists('company_departments', 'id'),
                new OwnsDepartment(),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->project->id]);
    }
}
