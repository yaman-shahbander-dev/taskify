<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_TeamPaginatedResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="name", type="string", example="default company team #1730382974"),
 *     @OA\Property(property="department_name", type="string", example="default company department #1730382974"),
 *     @OA\Property(property="company_name", type="string", example="default company #1730382974"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21")
 * )
 */
class TeamPaginatedResource extends JsonResource
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
            'department_name' => $this->department_name,
            'company_name' => $this->company_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
