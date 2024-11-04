<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_CompanyDepartmentPaginatedResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="company_id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ec71d"),
 *     @OA\Property(property="name", type="string", example="default company department #1730382974"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04 09:56:21"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04 09:56:21")
 * )
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     type="object",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(property="from", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=15),
 *     @OA\Property(property="to", type="integer", example=2),
 *     @OA\Property(property="total", type="integer", example=2),
 *     @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/company/v1/departments"),
 *     @OA\Property(
 *         property="links",
 *         type="object",
 *         @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/company/v1/departments?page=1"),
 *         @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/company/v1/departments?page=1"),
 *         @OA\Property(property="prev", type="string", nullable=true, example=null),
 *         @OA\Property(property="next", type="string", nullable=true, example=null)
 *     )
 * )
 */
class CompanyDepartmentPaginatedResource extends JsonResource
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
        ];
    }
}
