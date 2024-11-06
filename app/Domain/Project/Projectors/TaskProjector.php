<?php

namespace App\Domain\Project\Projectors;

use App\Domain\Project\Actions\CreateProjectTaskAction;
use App\Domain\Project\Events\ProjectTaskCreated;
use App\Support\Bases\BaseProjector;

class TaskProjector extends BaseProjector
{
    public function onProjectTaskCreated(ProjectTaskCreated $event)
    {
        return app(CreateProjectTaskAction::class)(
            $event->projectId,
            $event->data
        );
    }
}
