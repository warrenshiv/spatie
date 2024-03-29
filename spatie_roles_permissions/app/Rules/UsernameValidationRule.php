<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class UsernameValidationRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // TODO: Implement validate() method.
    }

    public function passes($attribute, $value)
    {
        // Check if the value is a valid email or phone number
        return Validator::make([$attribute => $value], [
                $attribute => ['nullable', 'string'],
            ])->passes() &&
            (filter_var($value, FILTER_VALIDATE_EMAIL) || $this->isValidPhoneNumber($value));
    }

    protected function isValidPhoneNumber($value)
    {
        // Implement phone number validation logic here
        // Return true if the phone number is valid, false otherwise
        // Example implementation: return preg_match('/your-regex-pattern/', $value);
        return strlen($value) === 12;
    }

    public function message()
    {
        return 'The username must be a valid email or phone number.';
    }


}
