<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\DataTransferObjects\UserData;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class UserRegistered extends ShouldBeStored
{
    public function __construct(
        public UserData $data
    ) {
    }
}
