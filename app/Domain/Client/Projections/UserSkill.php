<?php

namespace App\Domain\Client\Projections;

use App\Support\Bases\BaseProjection;

class UserSkill extends BaseProjection
{
    protected $table = 'user_skills';

    public function getKeyName(): string
    {
        return 'id';
    }
}
