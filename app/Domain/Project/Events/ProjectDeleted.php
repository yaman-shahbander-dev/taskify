<?php

namespace App\Domain\Project\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProjectDeleted extends ShouldBeStored
{
    public function __construct(
        public string $projectId
    ) {
    }
}
