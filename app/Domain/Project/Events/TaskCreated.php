<?php

namespace App\Domain\Project\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TaskCreated extends ShouldBeStored
{
    public function __construct(
        public string $sprintId,
        public array $data,
        public ?string $projectId = null,
    ) {
    }
}
