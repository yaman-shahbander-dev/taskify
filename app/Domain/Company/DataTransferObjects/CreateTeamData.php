<?php

namespace App\Domain\Company\DataTransferObjects;

use App\Support\Bases\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CreateTeamData extends BaseData
{
    public function __construct(
        public string $id,
        public string $departmentId,
        public string $name
    ) {
    }
}
