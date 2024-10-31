<?php

namespace App\Support\Bases;

use App\Support\Traits\GeneratesUuidTrait;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class BaseProjector extends Projector
{
    use GeneratesUuidTrait;
}
