<?php

namespace App\Domain\Project\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class SprintDeleted extends ShouldBeStored
{
    public function __construct(
        public string $sprintId
    ) {
    }
}
