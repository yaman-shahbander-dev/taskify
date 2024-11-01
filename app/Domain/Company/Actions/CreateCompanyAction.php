<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToCreateCompanyException;
use App\Domain\Company\Projections\Company;

class CreateCompanyAction
{
    public function __construct(protected Company $company)
    {
    }
    public function __invoke(string $id, string $userId, string $name, string $address, string $contactNumber): ?Company
    {
        $company = $this->company->writeable()->create([
            'id' => $id,
            'user_id' => $userId,
            'name' => $name,
            'address' => $address,
            'contact_number' => $contactNumber,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$company) {
            throw new FailedToCreateCompanyException();
        }

        return $company;
    }
}
