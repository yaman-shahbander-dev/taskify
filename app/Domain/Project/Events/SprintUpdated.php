<?php

namespace App\Domain\Project\Events;

use App\Domain\Project\DataTransferObjects\SprintData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class SprintUpdated extends ShouldBeStored
{
    public function __construct(
        public SprintData $data
    ) {
    }
}
