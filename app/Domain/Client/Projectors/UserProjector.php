<?php

namespace App\Domain\Client\Projectors;

use App\Domain\Client\Actions\AssignCompanyRoleAction;
use App\Domain\Client\Actions\CheckLoginCredentialsAction;
use App\Domain\Client\Enums\RolesEnum;
use App\Domain\Client\Events\AdminLoggedIn;
use App\Domain\Client\Events\CompanyLoggedIn;
use App\Domain\Client\Events\CompanyRoleAssigned;
use App\Domain\Client\Events\EmployeeLoggedIn;
use App\Support\Bases\BaseProjector;
use App\Domain\Client\Events\UserRegistered;
use App\Domain\Client\Actions\RegisterUserAction;

class UserProjector extends BaseProjector
{
    public function onUserRegistered(UserRegistered $event)
    {
        return app(RegisterUserAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->email,
            $event->data->password
        );
    }

    public function onCompanyRoleAssigned(CompanyRoleAssigned $event)
    {
        return app(AssignCompanyRoleAction::class)(
            $event->userId,
        );
    }

    public function onAdminLoggedIn(AdminLoggedIn $event)
    {
        return app(CheckLoginCredentialsAction::class)(
            $event->data->email,
            $event->data->password,
            RolesEnum::ADMIN->value
        );
    }

    public function onCompanyLoggedIn(CompanyLoggedIn $event)
    {
        return app(CheckLoginCredentialsAction::class)(
            $event->data->email,
            $event->data->password,
            RolesEnum::COMPANY->value
        );
    }

    public function onEmployeeLoggedIn(EmployeeLoggedIn $event)
    {
        return app(CheckLoginCredentialsAction::class)(
            $event->data->email,
            $event->data->password,
            RolesEnum::EMPLOYEE->value
        );
    }
}
