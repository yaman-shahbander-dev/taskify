<?php

namespace App\Domain\Project\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProjectDepartmentCreated extends ShouldBeStored
{
    public function __construct(
        public string $projectId,
        public array $data
    ) {
    }
}
