<?php

namespace App\Domain\Project\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class Project extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'projects';

    public function getKeyName(): string
    {
        return 'id';
    }
}
