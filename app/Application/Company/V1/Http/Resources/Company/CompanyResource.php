<?php

namespace App\Application\Company\V1\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations\OpenApi AS OA;

/**
 * @OA\Schema(
 *      schema="Company_CompanyResponse",
 *      type="object",
 *      @OA\Property(property="id", type="string", format="uuid", example="9d685465-112e-496a-91ff-4c70911d72f1"),
 *      @OA\Property(property="user_id", type="string", format="uuid", example="9d685464-e696-4041-a73b-688dd08293e9"),
 *      @OA\Property(property="name", type="string", example="default company #1730714180"),
 *      @OA\Property(property="address", type="string", example="Yaman Street"),
 *      @OA\Property(property="contact_number", type="string", example="+963996222469")
 *  )
 * */
class CompanyResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'contact_number' => $this->contact_number,
        ];
    }
}
