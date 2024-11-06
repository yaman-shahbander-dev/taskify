<?php

namespace App\Domain\Project\Partials;

use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\Events\SprintCreated;
use App\Domain\Project\Events\SprintDeleted;
use App\Domain\Project\Events\SprintUpdated;
use App\Domain\Project\Events\TaskCreated;
use App\Support\Bases\BaseAggregatePartial;

class SprintAggregatePartial extends BaseAggregatePartial
{
    public function createSprint(SprintData $data): static
    {
        $this->recordThat(new SprintCreated($data));

        if ($data->tasks) {
            $this->recordThat(new TaskCreated($data->id, $data->tasks, $data->projectId));
        }

        return $this;
    }

    public function updateSprint(SprintData $data): static
    {
        $this->recordThat(new SprintUpdated($data));

        return $this;
    }

    public function deleteSprint(string $sprintId): static
    {
        $this->recordThat(new SprintDeleted($sprintId));

        return $this;
    }
}
