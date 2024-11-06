<?php

namespace App\Application\Company\V1\Http\Requests\Project;

use App\Application\Company\V1\Rules\OwnsProject;
use App\Domain\Project\Enums\SprintStatusEnum;
use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;

class CreateSprintRequest extends BaseRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'string',
                new OwnsProject(),
            ],
            'number' => [
                'required',
                'integer',
                'min:1',
            ],
            'start' => [
                'required',
                'date',
            ],
            'end' => [
                'required',
                'date',
                'after:start',
            ],
            'goal' => [
                'required',
                'string',
                'min:1'
            ],
            'status' => [
                'required',
                'string',
                Rule::in(SprintStatusEnum::getValues())
            ],
            'tasks' => [
                'nullable',
                'array',
            ],
            'tasks.*.priority_id' => [
                'required_with:tasks',
                'string',
                Rule::exists('priority_levels', 'id'),
            ],
            'tasks.*.assigned_to' => [
                'required_with:tasks',
                'string',
                Rule::exists('users', 'id'),
            ],
            'tasks.*.title' => [
                'required_with:tasks',
                'string',
                'min:1',
                'max:255',
            ],
            'tasks.*.description' => [
                'required_with:tasks',
                'string',
                'min:1',
            ],
        ];
    }
}
