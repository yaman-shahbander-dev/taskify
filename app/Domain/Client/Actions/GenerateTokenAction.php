<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\Projections\User;

class GenerateTokenAction
{
    public function __invoke(User $user): string
    {
        return $user->createToken(
            config('auth.defaults.token_name')
        )->accessToken;
    }
}
