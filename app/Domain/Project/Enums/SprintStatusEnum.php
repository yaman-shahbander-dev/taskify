<?php

namespace App\Domain\Project\Enums;

enum SprintStatusEnum: string
{
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
