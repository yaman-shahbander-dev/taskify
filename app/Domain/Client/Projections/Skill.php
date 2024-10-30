<?php

namespace App\Domain\Client\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class Skill extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'skills';

    public function getKeyName(): string
    {
        return 'id';
    }
}
