<?php

namespace App\Domain\Project\Events;

use App\Domain\Project\DataTransferObjects\SprintData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class SprintCreated extends ShouldBeStored
{
    public function __construct(
        public SprintData $data
    ) {
    }
}
