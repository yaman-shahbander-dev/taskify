<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class TrainingMaterial extends BaseProjection
{
    protected $table = "training_materials";

    public function getKeyName(): string
    {
        return 'id';
    }
}
