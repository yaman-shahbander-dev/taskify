<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class Project extends BaseProjection
{
    protected $table = 'projects';

    public function getKeyName(): string
    {
        return 'id';
    }
}
