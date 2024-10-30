<?php

namespace App\Domain\Client\Builders;

use App\Domain\Client\Contracts\UserDataBuilderContract;
use App\Domain\Client\DataTransferObjects\UserData;
use App\Domain\Company\DataTransferObjects\CompanyData;
use App\Domain\Company\DataTransferObjects\CompanyDepartmentData;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use Carbon\CarbonImmutable;

class UserDataBuilder implements UserDataBuilderContract
{
    private ?string $id = null;
    private string $name;
    private string $email;
    private ?string $password = null;
    private ?CompanyData $companyData = null;
    private ?CompanyDepartmentData $companyDepartmentData = null;
    private ?DepartmentTeamData $departmentTeamData = null;
    private ?CarbonImmutable $createdAt = null;
    private ?CarbonImmutable $updatedAt = null;

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setCompanyData(?array $companyData): self
    {
        $this->companyData = CompanyData::from($companyData);
        return $this;
    }

    public function setCompanyDepartmentData(?array $companyDepartmentData): self
    {
        $this->companyDepartmentData = CompanyDepartmentData::from($companyDepartmentData);
        return $this;
    }

    public function setDepartmentTeamData(?array $departmentTeamData): self
    {
        $this->departmentTeamData = DepartmentTeamData::from($departmentTeamData);
        return $this;
    }

    public function setCreatedAt(?CarbonImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt(?CarbonImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function build(): UserData
    {
        return new UserData(
            id: $this->id,
            name: $this->name,
            email: $this->email,
            password: $this->password,
            companyData: $this->companyData,
            companyDepartmentData: $this->companyDepartmentData,
            departmentTeamData: $this->departmentTeamData,
            createdAt: $this->createdAt,
            updatedAt: $this->updatedAt
        );
    }
}
