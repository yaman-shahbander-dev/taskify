<?php

namespace App\Application\Admin\V1\Http\Controllers\Client;

use App\Application\Admin\V1\Http\Resources\Client\UserResource;
use App\Domain\Client\Actions\LoadUserAction;
use App\Domain\Client\ClientAggregate;
use App\Domain\Client\DataTransferObjects\UserLoginData;
use App\Support\Bases\BaseController;
use App\Application\Admin\V1\Http\Requests\Client\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Cache;
use OpenApi\Annotations\OpenApi AS OA;

class UserController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/admin/v1/client/login",
     *     tags={"Platform Access"},
     *     summary="Login as admin",
     *     description="This endpoint is used to login a user as admin",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="email", example="admin@admin.com"),
     *             @OA\Property(property="password", type="string", example="12345678"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AdminResponse")
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
                ->adminLogin($data)
                ->persist();
        } catch (Exception $exception) {
            return $this->failedResponse($exception->getMessage());
        }

        $user = app(LoadUserAction::class)($data->email, 'email');
        $user->bearerToken = Cache::get($data->email);

        return $this->okResponse(UserResource::make($user));
    }
}
