<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\DataTransferObjects\UserData;
use App\Domain\Client\Exceptions\UserNotFoundException;
use App\Domain\Client\Projections\User;

class LoadUserAction
{
    public function __construct(protected User $user)
    {
    }
    public function __invoke(string $value, string $column = 'id'): UserData
    {
        $user = $this->user->query()
            ->with([
                'companies',
                'departments',
                'teams',
            ])
            ->where($column, $value)
            ->firstOr(fn() => throw new UserNotFoundException());

        return UserData::from($user->toArray());
    }
}
