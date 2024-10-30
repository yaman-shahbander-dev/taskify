<?php

namespace App\Domain\Training\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class EmployeeTrainingEnrollment extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = "employee_training_enrollments";

    public function getKeyName(): string
    {
        return 'id';
    }
}
