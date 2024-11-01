<?php

namespace App\Application\Admin\V1\Http\Controllers\Client;

use App\Application\Admin\V1\Http\Resources\Client\UserResource;
use App\Domain\Client\Actions\LoadUserAction;
use App\Domain\Client\ClientAggregate;
use App\Domain\Client\DataTransferObjects\UserData;
use App\Support\Bases\BaseController;
use App\Application\Admin\V1\Http\Requests\Client\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Cache;


class UserController extends BaseController
{
    public function login(LoginUserRequest $request)//: JsonResponse
    {
        $data = UserData::fromUserLogin($request->validated());

        try {
            ClientAggregate::retrieve($this->generateUuid())
                ->adminLogin($data)
                ->persist();

        } catch (Exception $exception) {
            return $this->failedResponse($exception->getMessage());
        }

        $user = app(LoadUserAction::class)($data->email, 'email');
        return $user;

        $user->bearerToken = Cache::get($data->email);
        return $this->okResponse(UserResource::make($user));
    }
}
