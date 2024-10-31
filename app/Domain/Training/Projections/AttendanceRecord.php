<?php

namespace App\Domain\Training\Projections;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EventSourcing\Projections\Projection;

class AttendanceRecord extends Projection
{
    use HasFactory;
    use HasUuids;

    protected $table = "attendance_records";

    public function getKeyName(): string
    {
        return 'id';
    }
}
