<?php

namespace App\Domain\Project\Projectors;

use App\Domain\Project\Actions\CreateProjectTaskAction;
use App\Domain\Project\Actions\CreateTaskAction;
use App\Domain\Project\Events\ProjectTaskCreated;
use App\Domain\Project\Events\TaskCreated;
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

    public function onTaskCreated(TaskCreated $event)
    {
        return app(CreateTaskAction::class)(
            $event->sprintId,
            $event->data,
            $event->projectId
        );
    }
}
