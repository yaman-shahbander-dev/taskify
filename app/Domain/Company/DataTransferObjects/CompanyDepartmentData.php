<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CompanyDepartmentData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $companyId,
        public ?string $name,
        public ?CarbonImmutable $createdAt,
        public ?CarbonImmutable $updatedAt,
    ) {
    }
}
