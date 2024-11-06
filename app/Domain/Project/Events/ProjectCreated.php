<?php

namespace App\Domain\Project\Events;

use App\Domain\Project\DataTransferObjects\ProjectData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProjectCreated extends ShouldBeStored
{
    public function __construct(
        public ProjectData $data
    ) {
    }
}
