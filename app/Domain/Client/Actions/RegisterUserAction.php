<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\Events\UserRegistered;

class RegisterUserAction
{
    public function __invoke(string $id, string $name, string $email, string $password)
    {
        return app(CreateUserAction::class)(
            $id,
            $name,
            $email,
            $password
        );
    }
}
