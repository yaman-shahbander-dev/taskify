<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;

class TeamMemberRole extends BaseProjection
{
    protected $table = 'team_member_roles';

    public function getKeyName(): string
    {
        return 'id';
    }
}
