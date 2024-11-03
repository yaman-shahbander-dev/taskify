<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class Task extends BaseProjection
{
    protected $table = 'tasks';

    public function getKeyName(): string
    {
        return 'id';
    }
}
