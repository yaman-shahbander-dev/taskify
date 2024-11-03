<?php

namespace App\Domain\Client\Projections;

use App\Support\Bases\BaseProjection;

class UserSprintAssignment extends BaseProjection
{
    protected $table = 'user_sprint_assignments';

    public function getKeyName(): string
    {
        return 'id';
    }
}
