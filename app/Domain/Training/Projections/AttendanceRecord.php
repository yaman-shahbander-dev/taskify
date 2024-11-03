<?php

namespace App\Domain\Training\Projections;

use App\Support\Bases\BaseProjection;

class AttendanceRecord extends BaseProjection
{
    protected $table = "attendance_records";

    public function getKeyName(): string
    {
        return 'id';
    }
}
