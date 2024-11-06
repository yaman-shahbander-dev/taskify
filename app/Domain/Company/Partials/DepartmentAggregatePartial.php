<?php

namespace App\Domain\Company\Partials;

use App\Domain\Company\DataTransferObjects\CreateDepartmentData;
use App\Domain\Company\DataTransferObjects\UpdateDepartmentData;
use App\Domain\Company\Events\DepartmentCreated;
use App\Domain\Company\Events\DepartmentDeleted;
use App\Domain\Company\Events\DepartmentUpdated;
use App\Domain\Company\Events\TeamCreated;
use App\Domain\Company\Events\TeamUpdated;
use App\Domain\Company\Factories\TeamDataDTOFactory;
use App\Support\Bases\BaseAggregatePartial;

class DepartmentAggregatePartial extends BaseAggregatePartial
{
    public function createDepartment(CreateDepartmentData $data): static
    {
        $this->recordThat(new DepartmentCreated($data));

        if ($data->teamName) {
            $teamData = app(TeamDataDTOFactory::class)->create($data);

            $this->recordThat(new TeamCreated($teamData));
        }

        return $this;
    }

    public function updateDepartment(UpdateDepartmentData $data): static
    {
        $this->recordThat(new DepartmentUpdated($data));

        if ($data->teamName && $data->teamId) {
            $teamData = app(TeamDataDTOFactory::class)->createForUpdate($data);
            $this->recordThat(new TeamUpdated($teamData));
        }

        return $this;
    }

    public function deleteDepartment(string $departmentId): static
    {
        $this->recordThat(new DepartmentDeleted($departmentId));

        return $this;
    }
}
