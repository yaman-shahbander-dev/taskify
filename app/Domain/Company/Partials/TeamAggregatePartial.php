<?php

namespace App\Domain\Company\Partials;

use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Domain\Company\Events\TeamCreated;
use App\Domain\Company\Events\TeamDeleted;
use App\Domain\Company\Events\TeamUpdated;
use Spatie\EventSourcing\AggregateRoots\AggregatePartial;

class TeamAggregatePartial extends AggregatePartial
{
    public function createTeam(DepartmentTeamData $data): static
    {
        $this->recordThat(new TeamCreated($data));

        return $this;
    }

    public function updateTeam(DepartmentTeamData $data): static
    {
        $this->recordThat(new TeamUpdated($data));

        return $this;
    }

    public function deleteTeam(string $teamId): static
    {
        $this->recordThat(new TeamDeleted($teamId));

        return $this;
    }
}
