<?php

namespace App\Http\Requests;

use App\Rules\UsernameValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'username' => ['required', 'string', new UsernameValidationRule()],
            'password' => ['required', 'string', 'min:6']
        ];
    }
}
