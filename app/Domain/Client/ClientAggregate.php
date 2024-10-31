<?php

namespace App\Domain\Client;

use App\Domain\Client\Events\CompanyRoleAssigned;
use App\Domain\Client\Events\UserRegistered;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Events\CompanyDepartmentCreated;
use App\Domain\Company\Events\DepartmentTeamCreated;
use App\Support\Bases\BaseAggregate;
use App\Domain\Client\DataTransferObjects\UserData;

class ClientAggregate extends BaseAggregate
{
    public function registerUser(UserData $data): static
    {
        $this->generateAndAssignIds($data);

        $this->recordThat(new UserRegistered($data));
        $this->recordThat(new CompanyCreated($data->companyData));
        $this->recordThat(new CompanyDepartmentCreated($data->companyDepartmentData));
        $this->recordThat(new DepartmentTeamCreated($data->departmentTeamData));
        $this->recordThat(new CompanyRoleAssigned($data->id));

        return $this;
    }

    protected function generateAndAssignIds(UserData $data): void
    {
        $data->companyData->id = $this->generateUuid();
        $data->companyDepartmentData->id = $this->generateUuid();
        $data->departmentTeamData->id = $this->generateUuid();

        $data->companyDepartmentData->companyId = $data->companyData->id;
        $data->departmentTeamData->departmentId = $data->companyDepartmentData->id;
    }
}
