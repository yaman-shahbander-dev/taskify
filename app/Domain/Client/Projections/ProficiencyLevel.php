<?php

namespace App\Domain\Client\Projections;

use App\Support\Bases\BaseProjection;

class ProficiencyLevel extends BaseProjection
{
    protected $table = 'proficiency_levels';

    public function getKeyName(): string
    {
        return 'id';
    }
}
