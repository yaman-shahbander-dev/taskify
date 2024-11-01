<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class Sprint extends BaseProjection
{
    protected $table = 'sprints';

    public function getKeyName(): string
    {
        return 'id';
    }
}
