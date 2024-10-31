<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\DataTransferObjects\CompanyData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CompanyCreated extends ShouldBeStored
{
    public function __construct(
        public CompanyData $data
    ) {
    }
}
