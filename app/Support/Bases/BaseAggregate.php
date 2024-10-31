<?php

namespace App\Support\Bases;

use App\Support\Traits\GeneratesUuidTrait;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class BaseAggregate extends AggregateRoot
{
    use GeneratesUuidTrait;
}
