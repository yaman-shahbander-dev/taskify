<?php

namespace App\Application\Employee\V1\Http\Controllers\Client;

use App\Application\Employee\V1\Http\Requests\Client\LoginUserRequest;
use App\Application\Employee\V1\Http\Resources\Client\UserResource;
use App\Domain\Client\Actions\LoadUserAction;
use App\Domain\Client\ClientAggregate;
use App\Domain\Client\DataTransferObjects\UserLoginData;
use App\Support\Bases\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations as OA;

class UserController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/employee/v1/client/login",
     *     tags={"Platform Access"},
     *     summary="Login as employee",
     *     description="This endpoint is used to login a user as employee",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="email", example="company@company.com"),
     *             @OA\Property(property="password", type="string", example="12345678"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/EmployeeResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unprocessable Content"),
     *             @OA\Property(property="errors", type="array",
     *                  @OA\Items(type="string", example="The email field is required."),
     *             ),
     *         )
     *     )
     * )
     * */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $data = UserLoginData::from($request->validated());

        try {
            ClientAggregate::retrieve($this->generateUuid())
                ->employeeLogin($data)
                ->persist();
        } catch (Exception $exception) {
            return $this->failedResponse($exception->getMessage());
        }

        $user = app(LoadUserAction::class)($data->email, 'email');
        $user->bearerToken = Cache::get($data->email);

        return $this->okResponse(UserResource::make($user));
    }
}
