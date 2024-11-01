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
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $bearerToken = null;
    private ?array $companiesData = null;
    private ?CompanyDepartmentData $departmentsData = null;
    private ?DepartmentTeamData $teamsData = null;
//    private ?CarbonImmutable $createdAt = null;
//    private ?CarbonImmutable $updatedAt = null;

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setBearerToken(?string $bearerToken): self
    {
        $this->bearerToken = $bearerToken;
        return $this;
    }

    public function setCompaniesData(?array $companies): self
    {
        $this->companiesData = CompanyData::collect($companies);
        return $this;
    }

    public function setDepartmentsData(?array $departments): self
    {
        $this->departmentsData = CompanyDepartmentData::from($departments);
        return $this;
    }

    public function setTeamsData(?array $teams): self
    {
        $this->teamsData = DepartmentTeamData::from($teams);
        return $this;
    }

//    public function setCreatedAt(?CarbonImmutable $createdAt): self
//    {
//        $this->createdAt = $createdAt;
//        return $this;
//    }
//
//    public function setUpdatedAt(?CarbonImmutable $updatedAt): self
//    {
//        $this->updatedAt = $updatedAt;
//        return $this;
//    }

    public function build(): UserData
    {
        return new UserData(
            id: $this->id,
            name: $this->name,
            email: $this->email,
            password: $this->password,
            bearerToken: $this->bearerToken,
            companies: $this->companiesData,
            departments: $this->departmentsData,
            teams: $this->teamsData,
//            createdAt: $this->createdAt,
//            updatedAt: $this->updatedAt
        );
    }
}
