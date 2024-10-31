<?php

namespace App\Domain\Company\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class DepartmentTeam extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'departments_teams';

    protected $fillable = ['id', 'department_id', 'name'];

    public function getKeyName(): string
    {
        return 'id';
    }
}
