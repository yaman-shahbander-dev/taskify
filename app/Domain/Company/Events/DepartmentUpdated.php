<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\DataTransferObjects\UpdateDepartmentData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class DepartmentUpdated extends ShouldBeStored
{
    public function __construct(
        public UpdateDepartmentData $data
    ) {
    }
}
