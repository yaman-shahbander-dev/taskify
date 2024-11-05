<?php

namespace App\Domain\Company;

use App\Domain\Company\DataTransferObjects\CreateDepartmentData;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Domain\Company\DataTransferObjects\UpdateDepartmentData;
use App\Domain\Company\Partials\DepartmentAggregatePartial;
use App\Domain\Company\Partials\TeamAggregatePartial;
use App\Support\Bases\BaseAggregate;

class CompanyAggregate extends BaseAggregate
{
    protected DepartmentAggregatePartial $department;
    protected TeamAggregatePartial $team;

    public function __construct() {
        $this->department = new DepartmentAggregatePartial($this);
        $this->team = new TeamAggregatePartial($this);
    }

    public function createDepartment(CreateDepartmentData $data): static
    {
        $this->department->createDepartment($data);

        return $this;
    }

    public function updateDepartment(UpdateDepartmentData $data): static
    {
        $this->department->updateDepartment($data);

        return $this;
    }

    public function deleteDepartment(string $departmentId): static
    {
        $this->department->deleteDepartment($departmentId);

        return $this;
    }

    public function createTeam(DepartmentTeamData $data): static
    {
        $this->team->createTeam($data);

        return $this;
    }

    public function updateTeam(DepartmentTeamData $data): static
    {
        $this->team->updateTeam($data);

        return $this;
    }

    public function deleteTeam(string $teamId): static
    {
        $this->team->deleteTeam($teamId);

        return $this;
    }
}
