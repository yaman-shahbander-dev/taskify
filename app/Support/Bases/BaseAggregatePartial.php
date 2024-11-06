<?php

namespace App\Support\Bases;

use App\Support\Traits\GeneratesUuidTrait;
use Spatie\EventSourcing\AggregateRoots\AggregatePartial;

class BaseAggregatePartial extends AggregatePartial
{
    use GeneratesUuidTrait;
}
