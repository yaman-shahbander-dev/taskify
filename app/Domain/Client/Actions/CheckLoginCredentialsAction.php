<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\Exceptions\IncorrectPasswordException;
use App\Domain\Client\Exceptions\IncorrectRoleException;
use App\Domain\Client\Exceptions\UserNotFoundException;
use App\Domain\Client\Projections\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class CheckLoginCredentialsAction
{
    public function __construct(protected User $user)
    {
    }

    public function __invoke(string $email, string $password, string $role): void
    {
        $user = $this->user->query()
            ->where('email', $email)
            ->firstOr(fn() => throw new UserNotFoundException());

        if (!Hash::check($password, $user->password)) {
            throw new IncorrectPasswordException();
        }

        if (!$user->hasRole($role)) {
            throw new IncorrectRoleException();
        }

        if (!Cache::has($user->email)) {
            $token = app(GenerateTokenAction::class)($user);
            Cache::put($user->email, $token, 300);
        }
    }
}
