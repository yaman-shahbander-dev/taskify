<?php

namespace App\Domain\Client\Contracts;
use Carbon\CarbonImmutable;
use App\Domain\Client\DataTransferObjects\UserData;

interface UserDataBuilderContract
{
    public function setId(?string $id): self;
    public function setName(?string $name): self;
    public function setEmail(?string $email): self;
    public function setPassword(?string $password): self;
    public function setBearerToken(?string $bearerToken): self;
    public function setCompaniesData(?array $companies): self;
    public function setDepartmentsData(?array $departments): self;
    public function setTeamsData(?array $teams): self;
//    public function setCreatedAt(?CarbonImmutable $createdAt): self;
//    public function setUpdatedAt(?CarbonImmutable $updatedAt): self;
    public function build(): UserData;
}
