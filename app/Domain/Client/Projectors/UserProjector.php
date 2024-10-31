<?php

namespace App\Domain\Client\Projectors;

use App\Domain\Client\Actions\AssignCompanyRoleAction;
use App\Domain\Client\Events\CompanyRoleAssigned;
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
}
