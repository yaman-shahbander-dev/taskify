<?php

namespace App\Models\training;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTrainingEnrollment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "employee_training_enrollments";
}
