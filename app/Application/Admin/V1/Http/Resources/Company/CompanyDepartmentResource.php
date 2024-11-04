<?php

namespace App\Application\Admin\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Application\Admin\V1\Http\Resources\Company\CompanyResource;
use App\Application\Admin\V1\Http\Resources\Company\DepartmentTeamResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Admin/fullCompanyDepartmentResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="company_id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ec71d"),
 *     @OA\Property(property="name", type="string", example="default company department #1730382974"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(
 *         property="company",
 *         type="object",
 *         @OA\Schema(ref="#/components/schemas/Admin_CompanyResponse")
 *     ),
 *     @OA\Property(
 *         property="department_teams",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Admin_DepartmentTeamResponse")
 *     ),
 * )
 *
 */
class CompanyDepartmentResource extends JsonResource
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
            'company_id' => $this->company_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'company' => CompanyResource::make($this->whenLoaded('company')),
            'department_teams' => DepartmentTeamResource::collection($this->whenLoaded('departmentTeams')),
        ];
    }
}
