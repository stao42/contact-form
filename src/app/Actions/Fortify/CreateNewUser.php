<?php

namespace App\Actions\Fortify;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Create a temporary RegisterRequest instance to get rules and messages
        $request = new RegisterRequest();
        
        // Use the form request's validation rules and messages
        $rules = $request->rules();
        $messages = $request->messages();

        // Validate the input using the form request's rules and messages
        $validated = Validator::make($input, $rules, $messages)->validate();

        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }
}
