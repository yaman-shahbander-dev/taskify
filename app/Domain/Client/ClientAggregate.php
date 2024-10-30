<?php

namespace App\Domain\Client;

use App\Domain\Client\Events\UserRegistered;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use App\Domain\Client\DataTransferObjects\UserData;

class ClientAggregate extends AggregateRoot
{
    public function registerUser(UserData $data): static
    {
        $this->recordThat(new UserRegistered($data));

        return $this;
    }
}
