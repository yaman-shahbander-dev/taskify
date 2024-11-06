<?php

namespace App\Application\Company\V1\Http\Requests\Project;

use App\Application\Company\V1\Rules\OwnsProject;
use App\Application\Company\V1\Rules\OwnsTask;
use App\Domain\Project\Enums\SprintStatusEnum;
use App\Support\Bases\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateSprintRequest extends BaseRequest
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
            'task_ids' => [
                'nullable',
                'array',
                Rule::exists('tasks', 'id'),
                new OwnsTask()
            ],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'id' => $this->sprint->id
        ]);
    }
}
