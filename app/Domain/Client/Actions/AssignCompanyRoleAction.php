<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\Exceptions\UserNotFoundException;
use App\Domain\Client\Projections\User;
use App\Domain\Client\Enums\RolesEnum;

class AssignCompanyRoleAction
{
    public function __construct(protected User $user)
    {
    }
    public function __invoke(string $id)
    {
        $user = $this->user->query()
            ->where('id', $id)
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->assignRole(RolesEnum::COMPANY->value);

        return $user;
    }
}
