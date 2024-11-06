<?php

namespace App\Domain\Project\Projectors;

use App\Domain\Project\Actions\CreateSprintAction;
use App\Domain\Project\Events\SprintCreated;
use App\Support\Bases\BaseProjector;

class SprintProjector extends BaseProjector
{
    public function onSprintCreated(SprintCreated $event)
    {
        return app(CreateSprintAction::class)(
            $event->data
        );
    }
}
