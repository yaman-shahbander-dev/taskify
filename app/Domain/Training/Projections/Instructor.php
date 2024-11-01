<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class Instructor extends BaseProjection
{
    protected $table = "instructors";

    public function getKeyName(): string
    {
        return 'id';
    }
}
