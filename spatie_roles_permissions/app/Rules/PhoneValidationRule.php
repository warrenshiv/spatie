<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneValidationRule implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) !== 12) {
            $fail('The phone number must be exactly 12 characters.');
        }
    }

    public function passes($attribute, $value)
    {
        // Your custom validation logic for the "phone" field here
        // Return true if the value is valid, false otherwise
        return true;
    }

    public function message()
    {
        return 'The phone number is not valid.'; // Customize the error message
    }
}
