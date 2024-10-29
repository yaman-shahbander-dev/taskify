<?php

namespace App\Domain\Client\Enums;

use App\Support\Traits\EnumTrait;

enum PermissionsEnum: string
{
    use EnumTrait;

    case ALL = '*';
}
