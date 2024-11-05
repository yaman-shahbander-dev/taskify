<?php

namespace App\Domain\Project\Partials;

use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Support\Bases\BaseAggregatePartial;

class ProjectAggregatePartial extends BaseAggregatePartial
{
    public function createProject(ProjectData $data): static
    {
        return $this;
    }
}
