<?php

namespace App\Domain\Company\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TeamDeleted extends ShouldBeStored
{
    public function __construct(
        public string $teamId
    ) {
    }
}
