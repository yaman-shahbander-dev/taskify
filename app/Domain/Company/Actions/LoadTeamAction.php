<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Company\Projections\DepartmentTeam;

class LoadTeamAction
{
    public function __construct(protected DepartmentTeam $team)
    {
    }
    public function __invoke(string $value, string $column = 'id')
    {
        $team = $this->team->query()
            ->with([
                'companyDepartment',
                'company',
            ])
            ->where($column, $value)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        return $team;
    }
}
