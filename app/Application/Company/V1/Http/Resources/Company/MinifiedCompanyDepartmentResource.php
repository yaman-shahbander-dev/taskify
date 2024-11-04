<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Company_MinifiedCompanyDepartmentResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c26d-4612-a1b4-71a60d2d6927"),
 *     @OA\Property(property="company_id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ec71d"),
 *     @OA\Property(property="name", type="string", example="default company department #1730382974")
 * )
 * */
class MinifiedCompanyDepartmentResource extends JsonResource
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
            'company_id' => $this->companyId,
            'name' => $this->name,
        ];
    }
}
