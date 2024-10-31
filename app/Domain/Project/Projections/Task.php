<?php

namespace App\Domain\Project\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class Task extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'tasks';

    public function getKeyName(): string
    {
        return 'id';
    }
}
