<?php

namespace App\Domain\Client\Contracts;
use Carbon\CarbonImmutable;
use App\Domain\Client\DataTransferObjects\UserData;

interface UserDataBuilderContract
{
    public function setId(?string $id): self;
    public function setName(string $name): self;
    public function setEmail(string $email): self;
    public function setPassword(?string $password): self;
    public function setCompanyData(?array $companyData): self;
    public function setCompanyDepartmentData(?array $companyDepartmentData): self;
    public function setDepartmentTeamData(?array $departmentTeamData): self;
    public function setCreatedAt(?CarbonImmutable $createdAt): self;
    public function setUpdatedAt(?CarbonImmutable $updatedAt): self;
    public function build(): UserData;
}
