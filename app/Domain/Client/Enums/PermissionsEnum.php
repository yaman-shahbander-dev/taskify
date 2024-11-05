<?php

namespace App\Domain\Client\Enums;

use App\Support\Traits\EnumTrait;

enum PermissionsEnum: string
{
    use EnumTrait;

    case ALL = '*';
    case DEPARTMENTS = 'departments.*';
    case DEPARTMENTS_LIST = 'departments.list.*';
    case DEPARTMENTS_SHOW = 'departments.show.*';
    case DEPARTMENTS_STORE = 'departments.store.*';
    case DEPARTMENTS_UPDATE = 'departments.update.*';
    case DEPARTMENTS_DESTROY = 'departments.destroy.*';

    case TEAMS = 'teams.*';
    case TEAMS_LIST = 'teams.list.*';
    case TEAMS_SHOW = 'teams.show.*';
    case TEAMS_STORE = 'teams.store.*';
    case TEAMS_UPDATE = 'teams.update.*';
    case TEAMS_DESTROY = 'teams.destroy.*';
}
