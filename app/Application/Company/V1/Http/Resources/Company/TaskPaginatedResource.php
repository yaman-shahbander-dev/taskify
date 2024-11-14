<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_TaskPaginatedResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="title", type="string", example="created task title"),
 *     @OA\Property(property="description", type="string", example="created task desc"),
 *     @OA\Property(property="status", type="string", example="pending"),
 *     @OA\Property(property="project_name", type="string", example="taskify"),
 *     @OA\Property(property="priority", type="string", example="high"),
 *     @OA\Property(property="assigned_to_user", type="string", example="yaman"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-14 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-14 09:56:21")
 * )
 */
class TaskPaginatedResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'project_name' => $this->project_name,
            'priority' => $this->priority,
            'assigned_to_user' => $this->assigned_to_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
