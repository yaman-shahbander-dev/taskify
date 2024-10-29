<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $name,
        public string $email,
        public ?CompanyData $companyData,
        public ?CompanyDepartmentData $companyDepartmentData,
        public ?DepartmentTeamData $departmentTeamData,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $updatedAt,
    ) {
    }
}
