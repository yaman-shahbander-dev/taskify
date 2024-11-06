<?php

namespace App\Domain\Project\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProjectCompanyCreated extends ShouldBeStored
{
    public function __construct(
        public string $projectId,
        public array $data
    ) {
    }
}
