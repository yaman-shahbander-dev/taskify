<?php

namespace App\Application\Company\Http\Controllers\Client;

use App\Application\Company\Http\Requests\Client\RegisterUserRequest;
use App\Application\Company\Http\Resources\Client\UserResource;
use App\Domain\Client\ClientAggregate;
use App\Domain\Client\DataTransferObjects\UserData;
use App\Support\Bases\BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Exception;
use OpenApi\Annotations as OA;

class UserController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/company/client/register",
     *     tags={"Register"},
     *     summary="Register a company",
     *     description="This endpoint registers a user company",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="address", type="string", example="123 John Street"),
     *             @OA\Property(property="contact_number", type="string", example="+963996222469")
     *         )
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RegisterUserResponse")
     *     ),
     *
     *     @OA\Response(
     *          response=400,
     *          description="Failed operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Failed to create user")
     *          )
     *     ),
     * )
     *
     * */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $userData = UserData::fromUserRegister($validatedData);

        DB::beginTransaction();
        try {
            ClientAggregate::retrieve($id)
                ->registerUser($userData)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->failedResponse($exception->getMessage());
        }

        return $this->okResponse(UserResource::make($userData));
    }
}
