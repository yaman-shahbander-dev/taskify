<?php

namespace App\Application\Company\V1\Http\Resources\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_MinifiedSprintResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="project_id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="number", type="integer", example="1"),
 *     @OA\Property(property="start", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="end", type="string", format="date-time", example="2024-12-04 09:56:21"),
 *     @OA\Property(property="goal", type="string", example="feature x"),
 *     @OA\Property(property="status", type="string", example="in_progress"),
 * )
 * */
class MinifiedSprintResource extends JsonResource
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
        ];
    }
}
