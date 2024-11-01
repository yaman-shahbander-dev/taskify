<?php

namespace App\Domain\Client\DataTransferObjects;

use App\Support\Bases\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserLoginData extends BaseData
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
