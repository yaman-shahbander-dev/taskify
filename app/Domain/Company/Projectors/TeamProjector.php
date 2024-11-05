<?php

namespace App\Domain\Company\Projectors;

use App\Domain\Company\Actions\CreateDepartmentTeamAction;
use App\Domain\Company\Actions\DeleteTeamAction;
use App\Domain\Company\Actions\UpdateCompanyDepartmentTeamAction;
use App\Domain\Company\Events\DepartmentTeamCreated;
use App\Domain\Company\Events\TeamCreated;
use App\Domain\Company\Events\TeamDeleted;
use App\Domain\Company\Events\TeamUpdated;
use App\Support\Bases\BaseProjector;

class TeamProjector extends BaseProjector
{

    public function onDepartmentTeamCreated(DepartmentTeamCreated $event)
    {
        return app(CreateDepartmentTeamAction::class)(
            $event->data->id,
            $event->data->departmentId,
            $event->data->name
        );
    }

    public function onTeamCreated(TeamCreated $event)
    {
        return app(CreateDepartmentTeamAction::class)(
            $event->data->id,
            $event->data->departmentId,
            $event->data->name
        );
    }

    public function onTeamUpdated(TeamUpdated $event)
    {
        return app(UpdateCompanyDepartmentTeamAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->departmentId
        );
    }

    public function onTeamDeleted(TeamDeleted $event)
    {
        return app(DeleteTeamAction::class)(
            $event->teamId
        );
    }
}
