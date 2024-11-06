<?php

namespace App\Domain\Project\Enums;

use App\Support\Traits\EnumTrait;

enum SprintStatusEnum: string
{
    use EnumTrait;
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
