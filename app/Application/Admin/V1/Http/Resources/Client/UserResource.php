<?php

namespace App\Application\Admin\V1\Http\Resources\Client;

use App\Application\Company\V1\Http\Resources\Company\CompanyDepartmentResource;
use App\Application\Company\V1\Http\Resources\Company\CompanyResource;
use App\Application\Company\V1\Http\Resources\Company\DepartmentTeamResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RegisterUserResponse",
 *     type="object",
 *     @OA\Property(property="message", type="string", example="OK"),
 *     @OA\Property(property="data", type="object",
 *         @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-5f8a-449d-a89c-018b704fedb8"),
 *         @OA\Property(property="name", type="string", example="yaman"),
 *         @OA\Property(property="email", type="string", example="yaman@gmail.com"),
 *         @OA\Property(property="companies", ref="#/components/schemas/companyResponse"),
 *         @OA\Property(property="departments", ref="#/components/schemas/companyDepartmentResponse"),
 *         @OA\Property(property="teams", ref="#/components/schemas/departmentTeamResponse")
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
            'companies' => new CompanyResource($this->companies),
            'departments' => new CompanyDepartmentResource($this->departments),
            'teams' => new DepartmentTeamResource($this->teams),
        ];
    }
}
