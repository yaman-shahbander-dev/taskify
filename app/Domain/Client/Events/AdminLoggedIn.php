<?php

namespace App\Domain\Client\Events;

use App\Domain\Client\DataTransferObjects\UserData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class AdminLoggedIn extends ShouldBeStored
{
    public function __construct(
        public UserData $data
    ) {
    }
}
