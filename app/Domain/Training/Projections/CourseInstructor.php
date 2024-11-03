<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class CourseInstructor extends BaseProjection
{
    protected $table = "course_instructors";

    public function getKeyName(): string
    {
        return 'id';
    }
}
