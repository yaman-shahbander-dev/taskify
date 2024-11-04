<?php

namespace App\Domain\Company\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class DepartmentDeleted extends ShouldBeStored
{
    public function __construct(
        public string $departmentId
    ) {
    }
}
