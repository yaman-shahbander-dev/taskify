<?php

namespace App\Application\Company\V1\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class OwnsProject implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();
        $ownsProject = $user->companies()->whereHas('projects', function ($query) use ($value) {
            return $query->where('project_companies.project_id', $value);
        })->exists();

        if (!$ownsProject) {
            $fail('The selected project does not belong to you.');
        }
    }
}
