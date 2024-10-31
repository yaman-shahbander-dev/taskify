<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\DataTransferObjects\CompanyDepartmentData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CompanyDepartmentCreated extends ShouldBeStored
{
    public function __construct(
        public CompanyDepartmentData $data
    ) {
    }
}
