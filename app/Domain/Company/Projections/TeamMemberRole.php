<?php

namespace App\Domain\Company\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class TeamMemberRole extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'team_member_roles';

    public function getKeyName(): string
    {
        return 'id';
    }
}
