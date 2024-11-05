<?php

namespace App\Application\Company\V1\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class OwnsDepartment implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Auth::user()->departments()->where('company_departments.id', $value)->exists()) {
            $fail('The selected department does not belong to you.');
        }
    }
}
