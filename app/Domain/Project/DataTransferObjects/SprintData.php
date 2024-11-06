<?php

namespace App\Domain\Project\DataTransferObjects;

use App\Support\Bases\BaseData;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SprintData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $projectId,
        public ?string $number,
        public ?Carbon $start,
        public ?Carbon $end,
        public ?string $goal,
        public ?string $status,
        #[DataCollectionOf(TaskData::class)]
        public ?array $tasks,
        public ?array $taskIds
    ) {
    }
}
