<?php

namespace App\Domain\Client\DataTransferObjects;

use App\Domain\Company\DataTransferObjects\CompanyData;
use App\Domain\Company\DataTransferObjects\CompanyDepartmentData;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Support\Bases\BaseData;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $email,
        public ?string $password,
        public ?string $bearerToken,
        #[DataCollectionOf(CompanyData::class)]
        public ?Collection $companies,
        #[DataCollectionOf(CompanyDepartmentData::class)]
        public ?Collection $departments,
        #[DataCollectionOf(DepartmentTeamData::class)]
        public ?Collection $teams,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {
    }
}
