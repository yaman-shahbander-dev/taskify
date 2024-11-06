<?php

namespace App\Domain\Project\Actions;


use App\Domain\Project\Exceptions\FailedToCreateProjectDepartmentException;
use App\Domain\Project\Projections\ProjectDepartment;

class CreateProjectDepartmentAction
{
    public function __construct(protected ProjectDepartment $projectDepartment)
    {
    }

    public function __invoke(string $projectId, array $departments): bool
    {
        $data = [];
        foreach ($departments as $department) {
            $data[] = [
                'id' => generateUuid(),
                'project_id' => $projectId,
                'department_id' => $department,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $projectDepartments = $this->projectDepartment->writeable()->insertOrIgnore($data);

        if (!$projectDepartments) {
            throw new FailedToCreateProjectDepartmentException();
        }

        return true;
    }
}
