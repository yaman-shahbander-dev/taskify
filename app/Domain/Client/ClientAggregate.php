<?php

namespace App\Domain\Client;

use App\Domain\Client\Events\AdminLoggedIn;
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
        $this->generateDefaultNames($data);

        $this->recordThat(new UserRegistered($data));
        $this->recordThat(new CompanyCreated($data->companies));
        $this->recordThat(new CompanyDepartmentCreated($data->departments));
        $this->recordThat(new DepartmentTeamCreated($data->teams));
        $this->recordThat(new CompanyRoleAssigned($data->id));

        return $this;
    }

    public function adminLogin(UserData $data): static
    {
        $this->recordThat(new AdminLoggedIn($data));

        return $this;
    }

    protected function generateAndAssignIds(UserData $data): void
    {
        $data->companies->id = $this->generateUuid();
        $data->departments->id = $this->generateUuid();
        $data->teams->id = $this->generateUuid();

        $data->companies->userId = $data->id;
        $data->departments->companyId = $data->companies->id;
        $data->teams->departmentId = $data->departments->id;
    }

    protected function generateDefaultNames(UserData $data): void
    {
        $data->companies->name = 'default company #' . time();
        $data->departments->name = 'default company department #' . time();
        $data->teams->name = 'default department team #' . time();
    }
}
