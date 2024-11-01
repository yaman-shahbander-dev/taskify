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
    public function __invoke(string $value, string $column = 'id')//: User
    {
        $user = $this->user->query()
            ->where($column, $value)
            ->firstOr(fn() => throw new UserNotFoundException());

        $user->load(['companies', 'departments', 'teams']);

        return UserData::fromResponse($user->toArray());

        return $user->load(['companies', 'departments', 'teams']);
    }
}
