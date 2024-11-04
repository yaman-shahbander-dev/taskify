<?php

namespace App\Domain\Client\Actions;

use App\Domain\Client\Exceptions\FailedToCreateUserException;
use App\Domain\Client\Projections\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function __construct(protected User $user)
    {
    }
    public function __invoke(string $id, string $name, string $email, string $password)
    {
        $user = $this->user->query()->create([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$user) {
            throw new FailedToCreateUserException();
        }

        return $user;
    }
}
