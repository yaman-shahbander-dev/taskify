<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_fullTeamResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="department_id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ec71d"),
 *     @OA\Property(property="name", type="string", example="default company department #1730382974"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(
 *         property="company",
 *         type="object",
 *         @OA\Schema(ref="#/components/schemas/Company_CompanyResponse")
 *     ),
 *     @OA\Property(
 *         property="department",
 *         type="object",
 *         @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *         @OA\Property(property="company_id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *         @OA\Property(property="name", type="string", example="default company department #1730798296"),
 *         @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *         @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     ),
 * )
 *
 */
class TeamResource extends JsonResource
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
            'department_id' => $this->department_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'department' => CompanyDepartmentResource::make($this->whenLoaded('companyDepartment')),
            'company' => CompanyResource::make($this->whenLoaded('company')),
        ];
    }
}
