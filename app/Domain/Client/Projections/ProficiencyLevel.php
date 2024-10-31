<?php

namespace App\Domain\Client\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class ProficiencyLevel extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'proficiency_levels';

    public function getKeyName(): string
    {
        return 'id';
    }
}
