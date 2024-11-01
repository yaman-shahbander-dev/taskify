<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;

class TeamMember extends BaseProjection
{
    protected $table = 'team_members';

    public function getKeyName(): string
    {
        return 'id';
    }
}
