<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TeamCreated extends ShouldBeStored
{
    public function __construct(
        public DepartmentTeamData $data
    ) {
    }
}
