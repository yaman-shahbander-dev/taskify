<?php

namespace App\Domain\Client\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CompanyRoleAssigned extends ShouldBeStored
{
    public function __construct(
        public string $userId
    ) {
    }
}
