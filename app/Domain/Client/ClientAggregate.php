<?php

namespace App\Domain\Client;

use App\Domain\Client\DataTransferObjects\UserLoginData;
use App\Domain\Client\Events\AdminLoggedIn;
use App\Domain\Client\Events\CompanyLoggedIn;
use App\Domain\Client\Events\CompanyRoleAssigned;
use App\Domain\Client\Events\EmployeeLoggedIn;
use App\Domain\Client\Events\UserRegistered;
use App\Domain\Client\Factories\RegisterUserDTOFactory;
use App\Domain\Company\DataTransferObjects\CreateCompanyData;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Events\CompanyDepartmentCreated;
use App\Domain\Company\Events\DepartmentTeamCreated;
use App\Support\Bases\BaseAggregate;
use App\Domain\Client\DataTransferObjects\UserData;

class ClientAggregate extends BaseAggregate
{
    public function registerUser(CreateCompanyData $data): static
    {
        [$companyDTO, $departmentDTO, $teamDTO] = app(RegisterUserDTOFactory::class)->create($data);

        $this->recordThat(new UserRegistered(UserData::from($data)));
        $this->recordThat(new CompanyCreated($companyDTO));
        $this->recordThat(new CompanyDepartmentCreated($departmentDTO));
        $this->recordThat(new DepartmentTeamCreated($teamDTO));
        $this->recordThat(new CompanyRoleAssigned($data->id));

        return $this;
    }

    public function adminLogin(UserLoginData $data): static
    {
        $this->recordThat(new AdminLoggedIn($data));

        return $this;
    }

    public function companyLogin(UserLoginData $data): static
    {
        $this->recordThat(new CompanyLoggedIn($data));

        return $this;
    }

    public function employeeLogin(UserLoginData $data): static
    {
        $this->recordThat(new EmployeeLoggedIn($data));

        return $this;
    }
}
