<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class TrainingCourse extends BaseProjection
{
    protected $table = "training_courses";

    public function getKeyName(): string
    {
        return 'id';
    }
}
