<?php

namespace App\Domain\Client\Events;

use App\Domain\Client\DataTransferObjects\UserLoginData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class EmployeeLoggedIn extends ShouldBeStored
{
    public function __construct(
        public UserLoginData $data
    ) {
    }
}
