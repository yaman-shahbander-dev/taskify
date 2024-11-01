<?php

namespace App\Domain\Company\Projections;

use App\Support\Bases\BaseProjection;

class TrainingPolicy extends BaseProjection
{
    protected $table = 'training_policies';

    public function getKeyName(): string
    {
        return 'id';
    }
}
