<?php

namespace App\Domain\Project\DataTransferObjects;

use App\Support\Bases\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $description,
        public ?array $companies,
        public ?array $departments,
        public ?SprintData $sprint,
        #[DataCollectionOf(TaskData::class)]
        public ?array $tasks,
    ) {
    }
}
