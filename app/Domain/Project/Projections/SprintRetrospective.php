<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class SprintRetrospective extends BaseProjection
{
    protected $table = 'sprint_retrospectives';

    public function getKeyName(): string
    {
        return 'id';
    }
}
