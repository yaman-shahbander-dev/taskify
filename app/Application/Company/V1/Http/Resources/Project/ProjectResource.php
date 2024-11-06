<?php

namespace App\Application\Company\V1\Http\Resources\Project;

use App\Application\Company\V1\Http\Resources\Company\CompanyResource;
use App\Application\Company\V1\Http\Resources\Company\MinifiedCompanyDepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_FullProjectResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="name", type="string", example="default company team #1730382974"),
 *     @OA\Property(property="description", type="string", example="default company department #1730382974"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(
 *         property="companies",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Company_CompanyResponse")
 *     ),
 *     @OA\Property(
 *         property="departments",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Company_MinifiedCompanyDepartmentResponse")
 *     ),
 *     @OA\Property(
 *         property="sprints",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Company_MinifiedSprintResponse")
 *     ),
 *     @OA\Property(
 *         property="tasks",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Company_MinifiedTaskResponse")
 *     )
 * )
 */
class ProjectResource extends JsonResource
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
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'companies' => CompanyResource::collection($this->whenLoaded('companies')),
            'departments' => MinifiedCompanyDepartmentResource::collection($this->whenLoaded('departments')),
            'sprints' => MinifiedSprintResource::collection($this->whenLoaded('sprints')),
            'tasks' => MinifiedTaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
