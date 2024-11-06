<?php

namespace App\Application\Company\V1\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class OwnsTask implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = Auth::user();
        $ownsTask = $user->companies()->whereHas('projects.tasks', function ($query) use ($value) {
            return $query->where('tasks.id', $value);
        })->exists();

        if (!$ownsTask) {
            $fail('The selected task does not belong to you.');
        }
    }
}
