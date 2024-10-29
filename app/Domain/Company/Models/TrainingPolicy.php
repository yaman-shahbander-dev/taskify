<?php

namespace App\Domain\Company\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPolicy extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'training_policies';
}
