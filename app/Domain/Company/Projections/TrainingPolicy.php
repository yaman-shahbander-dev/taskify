<?php

namespace App\Domain\Company\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class TrainingPolicy extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = 'training_policies';

    public function getKeyName(): string
    {
        return 'id';
    }
}
