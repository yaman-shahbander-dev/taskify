<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToCreateCompanyDepartmentException;
use App\Domain\Company\Projections\CompanyDepartment;

class CreateCompanyDepartmentAction
{
    public function __construct(protected CompanyDepartment $companyDepartment)
    {
    }

    public function __invoke(string $id, string $companyId, string $name): ?CompanyDepartment
    {
        $companyDepartment = $this->companyDepartment->writeable()->create([
            'id' => $id,
            'company_id' => $companyId,
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$companyDepartment) {
            throw new FailedToCreateCompanyDepartmentException();
        }

        return $companyDepartment;
    }
}
