<?php

namespace App\Domain\Company\Actions;

use App\Domain\Company\Exceptions\FailedToFindTheDataException;
use App\Domain\Company\Exceptions\FailedToUpdateDepartmentTeamException;
use App\Domain\Company\Projections\DepartmentTeam;
use Illuminate\Support\Facades\Log;

class UpdateCompanyDepartmentTeamAction
{
    public function __construct(protected DepartmentTeam $team)
    {
    }

    public function __invoke(string $id, string $name): ?DepartmentTeam
    {
        $team = $this->team->query()
            ->where('id', $id)
            ->firstOr(fn() => throw new FailedToFindTheDataException());

        $result = $team->writeable()->update([
            'name' => $name
        ]);

        Log::debug('inside the action: ', ['data' => $result]);

        if (!$result) {
            throw new FailedToUpdateDepartmentTeamException();
        }

        return $team;
    }
}
