<?php

namespace App\Application\Company\Http\Controllers;

use App\Domain\Company\DataTransferObjects\UserData;
use App\Http\Controllers\Controller;
use App\Application\Company\Http\Requests\RegisterUserRequest;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        return $request->all();
        return 'inside';
        $data = UserData::from($request->validated());

        return $data;
    }
}
