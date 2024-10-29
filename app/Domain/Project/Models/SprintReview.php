<?php

namespace App\Domain\Project\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SprintReview extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sprint_reviews';
}