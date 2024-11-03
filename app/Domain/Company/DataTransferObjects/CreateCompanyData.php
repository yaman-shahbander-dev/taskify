<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateCompanyData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $email,
        public ?string $password,
        public ?string $address,
        public ?string $contactNumber,
    ) {
    }
}
