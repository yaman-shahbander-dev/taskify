<?php

namespace App\Domain\Client\Enums;

use App\Support\Traits\EnumTrait;

enum RolesEnum: string
{
    use EnumTrait;

    case ADMIN = 'Admin';
    case COMPANY = 'company';
    case MANAGER = 'manager';
    case TEAM_LEADER = 'team leader';
    case EMPLOYEE = 'employee';

    public static function getRolesPermissions(): array
    {
        return [
            self::ADMIN->value => [
                PermissionsEnum::DEPARTMENTS_LIST->value,
                PermissionsEnum::DEPARTMENTS_SHOW->value,
                PermissionsEnum::TEAMS_LIST->value,
                PermissionsEnum::TEAMS_SHOW->value,
                PermissionsEnum::PROJECTS_LIST->value,
                PermissionsEnum::PROJECTS_SHOW->value,
            ],
            self::COMPANY->value => [
                PermissionsEnum::DEPARTMENTS->value,
                PermissionsEnum::TEAMS->value,
                PermissionsEnum::PROJECTS->value,
            ],
            self::MANAGER->value => [
            ],
            self::TEAM_LEADER->value => [
            ],
            self::EMPLOYEE->value => [
            ],
        ];
    }
}
