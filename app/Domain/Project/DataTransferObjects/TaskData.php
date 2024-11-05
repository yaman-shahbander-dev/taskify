<?php

namespace App\Domain\Project\DataTransferObjects;

use App\Support\Bases\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TaskData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $projectId,
        public ?string $priorityId,
        public ?string $assignedTo,
        public ?string $title,
        public ?string $description,
        public ?string $status,
    ) {
    }
}
