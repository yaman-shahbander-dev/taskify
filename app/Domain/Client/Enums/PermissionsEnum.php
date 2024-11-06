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

    case PROJECTS = 'projects.*';
    case PROJECTS_LIST = 'projects.list.*';
    case PROJECTS_SHOW = 'projects.show.*';
    case PROJECTS_STORE = 'projects.store.*';
    case PROJECTS_UPDATE = 'projects.update.*';
    case PROJECTS_DESTROY = 'projects.destroy.*';

    case SPRINTS = 'sprints.*';
    case SPRINTS_LIST = 'sprints.list.*';
    case SPRINTS_SHOW = 'sprints.show.*';
    case SPRINTS_STORE = 'sprints.store.*';
    case SPRINTS_UPDATE = 'sprints.update.*';
    case SPRINTS_DESTROY = 'sprints.destroy.*';
}
