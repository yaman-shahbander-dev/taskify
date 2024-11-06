<?php

namespace App\Domain\Project\Actions;


use App\Domain\Project\Exceptions\FailedToCreateProjectCompanyException;
use App\Domain\Project\Projections\ProjectCompany;

class CreateProjectCompanyAction
{
    public function __construct(protected ProjectCompany $projectCompany)
    {
    }

    public function __invoke(string $projectId, array $companies): bool
    {
        $data = [];
        foreach ($companies as $company) {
            $data[] = [
                'id' => generateUuid(),
                'project_id' => $projectId,
                'company_id' => $company,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $projectCompanies = $this->projectCompany->writeable()->insertOrIgnore($data);

        if (!$projectCompanies) {
            throw new FailedToCreateProjectCompanyException();
        }
        
        return true;
    }
}
