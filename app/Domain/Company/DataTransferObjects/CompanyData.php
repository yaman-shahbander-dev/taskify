<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CompanyData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $userId,
        public ?string $name,
        public ?string $address,
        public ?string $contactNumber,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
    ) {
    }
}
