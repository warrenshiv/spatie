<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginUserRequest;


class AuthController extends Controller
{
    use HttpResponses;

    public function register(RegisterRequest $request)
    {
        $this -> authorize('create-delete-users');
        
        $validatedData = $request->validated();

        // Create a new User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password'])
        ]);

        // Return succes response
        return $this->success([
            'user' => $user,
            'access_token' => $user->createToken('API Token')->plainTextToken
        ]);
    }
    public function login(LoginUserRequest $request)
    {
        $validatedData = $request->validated();

        // Check if the input is a phone number
        if ($this->isPhoneNumber($validatedData['username'])) {
            $user = User::where('phone_number', $validatedData['username'])->first();
        } else {
            $user = User::where('email', $validatedData['username'])->first();
        }

        if (!$user || !Auth::attempt(['email' => $user->email, 'password' => $validatedData['password']])) {
            return $this->error('', 'Invalid credentials', 401);
        }

        return $this->success([
            'user' => $user,
            'access_token' => $user->createToken('API Token')->plainTextToken
        ]);
    }

    function isPhoneNumber($value)
    {
        // Check if $value is a valid numeric string
        return ctype_digit($value);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->currentAccessToken()->delete();
            return $this->success([
                'message' => 'You have successfully been logged out and your token has been removed'
            ]);
        } else {
            // Handle cases where the user is not authenticated
            return $this->error('', 'User not authenticated', 401);
        }
    }
}
