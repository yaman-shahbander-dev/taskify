<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class EmployeeTrainingEnrollment extends BaseProjection
{
    protected $table = "employee_training_enrollments";

    public function getKeyName(): string
    {
        return 'id';
    }
}
