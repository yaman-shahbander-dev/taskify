<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToDeleteTeamException;
use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Company\Projections\DepartmentTeam;

class DeleteTeamAction
{
    public function __construct(
        protected DepartmentTeam $team
    ) {
    }

    public function __invoke(string $teamId): ?true
    {
        $team = $this->team->query()
            ->where('id', $teamId)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        if (!$team->writeable()->delete()) {
            throw new FailedToDeleteTeamException();
        }

        return true;
    }
}
