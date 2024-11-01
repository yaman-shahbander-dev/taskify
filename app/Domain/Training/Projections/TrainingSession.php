<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class TrainingSession extends BaseProjection
{
    protected $table = "training_sessions";

    public function getKeyName(): string
    {
        return 'id';
    }
}
