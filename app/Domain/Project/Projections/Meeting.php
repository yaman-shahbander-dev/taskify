<?php

namespace App\Domain\Project\Projections;

use App\Support\Bases\BaseProjection;

class Meeting extends BaseProjection
{
    protected $table = 'meetings';

    public function getKeyName(): string
    {
        return 'id';
    }
}
