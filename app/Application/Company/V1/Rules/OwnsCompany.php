<?php

namespace App\Application\Company\V1\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class OwnsCompany implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Auth::user()->companies()->where('id', $value)->exists()) {
            $fail('The selected company does not belong to you.');
        }
    }
}
