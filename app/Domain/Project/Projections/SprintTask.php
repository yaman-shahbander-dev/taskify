<?php

namespace App\Domain\Project\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class SprintTask extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sprint_tasks';

    public function getKeyName(): string
    {
        return 'id';
    }
}
