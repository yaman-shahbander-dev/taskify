<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CompanyDepartmentData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $companyId,
        public ?string $name,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {
    }
}
