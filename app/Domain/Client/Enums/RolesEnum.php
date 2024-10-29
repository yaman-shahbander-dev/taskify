<?php

namespace App\Domain\Client\Enums;

use App\Support\Traits\EnumTrait;
use App\Domain\Client\Enums\PermissionsEnum;

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
                PermissionsEnum::ALL->value,
            ],
            self::COMPANY->value => [
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
