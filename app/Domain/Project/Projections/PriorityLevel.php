<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class PriorityLevel extends BaseProjection
{
    protected $table = 'priority_levels';

    public function getKeyName(): string
    {
        return 'id';
    }
}
