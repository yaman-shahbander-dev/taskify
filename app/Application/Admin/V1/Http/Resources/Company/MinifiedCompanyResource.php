<?php

namespace App\Application\Admin\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Admin_MinifiedcompanyResponse",
 *     type="object",
 *     @OA\Property(property="id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ec71d"),
 *     @OA\Property(property="user_id", type="string", format="uuid", example="9d609e3f-c241-4811-97e4-15cffe1ecsss"),
 *     @OA\Property(property="name", type="string", example="default company #1730382974"),
 *     @OA\Property(property="address", type="string", example="Yaman Street"),
 *     @OA\Property(property="contact_number", type="string", example="+963996222469")
 * )
 * */
class MinifiedCompanyResource extends JsonResource
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
            'user_id' => $this->userId,
            'name' => $this->name,
            'address' => $this->address,
            'contact_number' => $this->contactNumber
        ];
    }
}
