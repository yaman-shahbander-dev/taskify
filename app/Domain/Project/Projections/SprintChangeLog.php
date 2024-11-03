<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class SprintChangeLog extends BaseProjection
{
    protected $table = 'sprint_changes_log';

    public function getKeyName(): string
    {
        return 'id';
    }
}
