<?php

namespace App\Application\Company\V1\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_FullSprintResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="project_id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="number", type="integer", example="1"),
 *     @OA\Property(property="start", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="end", type="string", format="date-time", example="2024-11-24 09:56:21"),
 *     @OA\Property(property="goal", type="string", example="The goal of the sprint is..."),
 *     @OA\Property(property="status", type="string", example="in_progress"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(
 *         property="tasks",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Company_MinifiedTaskResponse")
 *     )
 * )
 */
class SprintResource extends JsonResource
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
            'project_id' => $this->project_id,
            'number' => $this->number,
            'start' => $this->start,
            'end' => $this->end,
            'goal' => $this->goal,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tasks' => MinifiedTaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
