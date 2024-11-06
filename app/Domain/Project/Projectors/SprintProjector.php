<?php

namespace App\Domain\Project\Projectors;

use App\Domain\Project\Actions\CreateSprintAction;
use App\Domain\Project\Actions\DeleteSprintAction;
use App\Domain\Project\Actions\UpdateSprintAction;
use App\Domain\Project\Events\SprintCreated;
use App\Domain\Project\Events\SprintDeleted;
use App\Domain\Project\Events\SprintUpdated;
use App\Support\Bases\BaseProjector;

class SprintProjector extends BaseProjector
{
    public function onSprintCreated(SprintCreated $event)
    {
        return app(CreateSprintAction::class)(
            $event->data
        );
    }

    public function onSprintUpdated(SprintUpdated $event)
    {
        return app(UpdateSprintAction::class)(
            $event->data
        );
    }

    public function onSprintDeleted(SprintDeleted $event)
    {
        return app(DeleteSprintAction::class)(
            $event->sprintId
        );
    }
}
