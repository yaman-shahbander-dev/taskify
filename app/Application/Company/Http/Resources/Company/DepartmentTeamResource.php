<?php

namespace App\Application\Company\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="departmentTeamResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c28e-4d18-a87b-5dbabda31632"),
 *     @OA\Property(property="department_id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="name", type="string", example="default department team #1730382974")
 * )
 * */
class DepartmentTeamResource extends JsonResource
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
            'department_id' => $this->departmentId,
            'name' => $this->name,
        ];
    }
}
