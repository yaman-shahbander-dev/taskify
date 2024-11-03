<?php

namespace App\Application\Company\V1\Http\Controllers\Client;

use App\Application\Company\V1\Http\Requests\Client\RegisterUserRequest;
use App\Application\Company\V1\Http\Resources\Client\UserResource;
use App\Domain\Client\Actions\LoadUserAction;
use App\Domain\Client\ClientAggregate;
use App\Domain\Company\DataTransferObjects\CreateCompanyData;
use App\Support\Bases\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class UserController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/company/v1/client/register",
     *     tags={"Platform Access"},
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResponse")
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
        $data = CreateCompanyData::from($validatedData);

        DB::beginTransaction();
        try {
            ClientAggregate::retrieve($id)
                ->registerUser($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->failedResponse($exception->getMessage());
        }

        $user = app(LoadUserAction::class)($data->email, 'email');
        return $this->okResponse(UserResource::make($user));
    }
}
