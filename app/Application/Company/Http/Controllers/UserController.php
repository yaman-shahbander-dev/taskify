<?php

namespace App\Application\Company\Http\Controllers;

use App\Application\Company\Http\Requests\RegisterUserRequest;
use App\Domain\Client\ClientAggregate;
use App\Domain\Client\DataTransferObjects\UserData;
use App\Support\Bases\BaseController;
use Exception;

class UserController extends BaseController
{
    public function register(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $userData = UserData::fromUserRegister($validatedData);

        try {
            ClientAggregate::retrieve($id)
                ->registerUser($userData)
                ->persist();
        } catch (Exception $exception) {
            // return json response
            return $exception->getMessage();
        }

        return $userData;
    }
}
