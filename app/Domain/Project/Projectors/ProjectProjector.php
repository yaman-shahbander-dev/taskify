<?php

namespace App\Domain\Project\Projectors;

use App\Domain\Project\Actions\CreateProjectAction;
use App\Domain\Project\Actions\CreateProjectCompanyAction;
use App\Domain\Project\Actions\CreateProjectDepartmentAction;
use App\Domain\Project\Actions\DeleteProjectAction;
use App\Domain\Project\Actions\UpdateProjectAction;
use App\Domain\Project\Events\ProjectCompanyCreated;
use App\Domain\Project\Events\ProjectCreated;
use App\Domain\Project\Events\ProjectDeleted;
use App\Domain\Project\Events\ProjectDepartmentCreated;
use App\Domain\Project\Events\ProjectUpdated;
use App\Support\Bases\BaseProjector;

class ProjectProjector extends BaseProjector
{
    public function onProjectCreated(ProjectCreated $event)
    {
        return app(CreateProjectAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->description,
        );
    }

    public function onProjectCompanyCreated(ProjectCompanyCreated $event)
    {
        return app(CreateProjectCompanyAction::class)(
            $event->projectId,
            $event->data
        );
    }

    public function onProjectDepartmentCreated(ProjectDepartmentCreated $event)
    {
        return app(CreateProjectDepartmentAction::class)(
            $event->projectId,
            $event->data
        );
    }

    public function onProjectUpdated(ProjectUpdated $event)
    {
        return app(UpdateProjectAction::class)(
            $event->data
        );
    }

    public function onProjectDeleted(ProjectDeleted $event)
    {
        return app(DeleteProjectAction::class)(
            $event->projectId
        );
    }
}
