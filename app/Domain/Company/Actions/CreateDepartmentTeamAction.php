<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToCreateDepartmentTeamException;
use App\Domain\Company\Projections\DepartmentTeam;

class CreateDepartmentTeamAction
{
    public function __construct(protected DepartmentTeam $departmentTeam)
    {
    }

    public function __invoke(string $id, string $departmentId, string $name): ?DepartmentTeam
    {
        $departmentTeam = $this->departmentTeam->writeable()->create([
            'id' => $id,
            'department_id' => $departmentId,
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$departmentTeam) {
            throw new FailedToCreateDepartmentTeamException();
        }

        return $departmentTeam;
    }
}
