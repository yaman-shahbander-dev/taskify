<?php

namespace App\Domain\Client\Projections;

use App\Support\Bases\BaseProjection;

class Skill extends BaseProjection
{
    protected $table = 'skills';

    public function getKeyName(): string
    {
        return 'id';
    }
}
