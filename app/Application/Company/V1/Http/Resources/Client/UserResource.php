<?php

namespace App\Application\Company\V1\Http\Resources\Client;

use App\Application\Company\V1\Http\Resources\Company\MinifiedCompanyDepartmentResource;
use App\Application\Company\V1\Http\Resources\Company\MinifiedCompanyResource;
use App\Application\Company\V1\Http\Resources\Company\DepartmentTeamResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_UserResponse",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="OK"),
 *     @OA\Property(property="data", type="object",
 *         @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-5f8a-449d-a89c-018b704fedb8"),
 *         @OA\Property(property="name", type="string", example="yaman"),
 *         @OA\Property(property="email", type="string", example="yaman@gmail.com"),
 *         @OA\Property(property="companies", ref="#/components/schemas/Company_MinifiedCompanyResponse"),
 *         @OA\Property(property="departments", ref="#/components/schemas/Company_MinifiedCompanyDepartmentResponse"),
 *         @OA\Property(property="teams", ref="#/components/schemas/Company_DepartmentTeamResponse")
 *     )
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bearer_token' => $this->bearerToken,
            'companies' => MinifiedCompanyResource::collection($this->companies),
            'departments' => MinifiedCompanyDepartmentResource::collection($this->departments),
            'teams' => DepartmentTeamResource::collection($this->teams),
        ];
    }
}
