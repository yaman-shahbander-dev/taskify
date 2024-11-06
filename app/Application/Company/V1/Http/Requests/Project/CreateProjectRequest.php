<?php

namespace App\Application\Company\V1\Http\Requests\Project;

use App\Application\Company\V1\Rules\OwnsCompany;
use App\Application\Company\V1\Rules\OwnsDepartment;
use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends BaseRequest
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
            'sprint' => [
                'required_with:tasks',
            ],
            'sprint.number' => [
                'required_with:sprint',
                'integer',
                'min:1'
            ],
            'sprint.start' => [
                'required_with:sprint',
                'date',
            ],
            'sprint.end' => [
                'required_with:sprint',
                'date',
                'after:sprint.start'
            ],
            'sprint.goal' => [
                'required_with:sprint',
                'string',
                'min:1',
            ],
            'tasks' => [
                'required_with:sprint',
                'array',
            ],
            'tasks.*.priority_id' => [
                'required',
                'string',
                Rule::exists('priority_levels', 'id'),
            ],
            'tasks.*.assigned_to' => [
                'required',
                'string',
                Rule::exists('users', 'id'),
            ],
            'tasks.*.title' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'tasks.*.description' => [
                'required',
                'string',
                'min:1',
            ],
        ];
    }
}
