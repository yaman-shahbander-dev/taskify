<?php

namespace App\Domain\Project\Events;

use App\Domain\Project\DataTransferObjects\ProjectData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProjectUpdated extends ShouldBeStored
{
    public function __construct(
        public ProjectData $data
    ) {
    }
}
